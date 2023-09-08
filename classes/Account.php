<?php
require_once('Database.php');
require_once('get_accounts.php');
class Account {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function addClient($data) {
       
        // Проверка соединения
        if ($conn->connect_error) {
            die("Ошибка соединения с базой данных: " . $conn->connect_error);
        }

        $conn = $this->db->getConn(); // геттер для получения доступа к свойству conn 
       
        // Валидация данных
        if (!$this->validateData($data["first_name"], $data["last_name"], $data["email"])) {
            return false;
        }

        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $company_name = $data["company_name"];
        $position = $data["position"];
        $phone1 = $data["phone1"];
        $phone2 = $data["phone2"];
        $phone3 = $data["phone3"];

        $company_id = $this->insertCompany($company_name); // Получаем ID компании или создаём новую

        $sql = "INSERT INTO clients (first_name, last_name, email, company_id, position)
                VALUES ('$first_name', '$last_name', '$email', '$company_id', '$position')";
        $result = $this->db->executeQuery($sql);

        if ($result) {

            $client_id = $this->db->getConn()->insert_id; // Получаем ID вставленного клиента
    
            // Вставка телефонов клиента
            if (!empty($phone1)) {
                $this->insertPhone($client_id, $phone1);
            }
            if (!empty($phone2)) {
                $this->insertPhone($client_id, $phone2);
            }
            if (!empty($phone3)) {
                $this->insertPhone($client_id, $phone3);
            }
    
            return $client_id; // Возвращаем ID вставленного клиента
        } else {
            return false;
        }
    }

    public function updateAccount($data) { // на самом приложении не доделал, увы
        // Валидация данных
        if (!$this->validateData($data["first_name"], $data["last_name"], $data["email"])) {
            return false;
        }

        $account_id = $data["account_id"];
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $company_name = $data["company_name"];
        $position = $data["position"];
        $phone1 = $data["phone1"];
        $phone2 = $data["phone2"];
        $phone3 = $data["phone3"];

        $sql = "UPDATE clients SET
                first_name = '$first_name',
                last_name = '$last_name',
                email = '$email',
                company_id = '$company_name',
                position = '$position'
                WHERE client_id = '$account_id'";

        $result = $this->db->executeQuery($sql);

        if ($result) {
            // Удаление старых телефонов
            $this->deletePhones($account_id);

            // Вставка новых телефонов
            if (!empty($phone1)) {
                $this->insertPhone($account_id, $phone1);
            }
            if (!empty($phone2)) {
                $this->insertPhone($account_id, $phone2);
            }
            if (!empty($phone3)) {
                $this->insertPhone($account_id, $phone3);
            }

            return true;
        } else {
            return false;
        }
    }

    public function deleteClient($client_id) {
        $conn = $this->db->getConn();
        $account = new Account($db); 
        if ($conn->connect_error) {
            die("Ошибка соединения с базой данных: " . $conn->connect_error);
        }
    
        try {
            $conn->begin_transaction();
    
            // Удаляем телефонные номера клиента, это нужно делать перед удалением клиента 
            $deletePhonesQuery = "DELETE FROM client_phones WHERE client_id = ?";
            $stmtPhones = $conn->prepare($deletePhonesQuery);
            $stmtPhones->bind_param("i", $client_id);
            $stmtPhones->execute();
            $stmtPhones->close();
    
            // Удаляем клиента
            $deleteClientQuery = "DELETE FROM clients WHERE client_id = ?";
            $stmtClient = $conn->prepare($deleteClientQuery);
            $stmtClient->bind_param("i", $client_id);
            $stmtClient->execute();
            $stmtClient->close();
    
            $conn->commit();
            $conn->close();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Ошибка при удалении клиента: " . $e->getMessage();
        }
    }
    

    public function getAccounts($limit, $page) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT clients.client_id, first_name, last_name, email, company_name, position, GROUP_CONCAT(phone_number) as phones
                FROM clients
                LEFT JOIN companies ON clients.company_id = companies.company_id
                LEFT JOIN client_phones ON clients.client_id = client_phones.client_id
                GROUP BY clients.client_id
                LIMIT $limit OFFSET $offset";
        $result = $this->db->executeQuery($sql);

        $accounts = [];
        while ($row = $result->fetch_assoc()) {
            $account = [
                "client_id" => $row["client_id"],
                "first_name" => $row["first_name"],
                "last_name" => $row["last_name"],
                "email" => $row["email"],
                "company_name" => $row["company_name"],
                "position" => $row["position"],
                "phones" => $row["phones"]
            ];
            $accounts[] = $account;
        }

        return $accounts;
    }

    public function insertCompany($companyName) {
        
        // Проверяем, существует ли компания с таким именем
        $sqlCheck = "SELECT company_id FROM companies WHERE company_name = '$companyName'";
        $resultCheck = $this->db->executeQuery($sqlCheck);
    
        if ($resultCheck->num_rows > 0) {
            $row = $resultCheck->fetch_assoc();
            return $row['company_id']; // Возвращает ID существующей компании
        } else {
            // Если компания не существует, то добавляем её
            $sqlInsert = "INSERT INTO companies (company_name) VALUES ('$companyName')";
            $resultInsert = $this->db->executeQuery($sqlInsert);
    
            if ($resultInsert) {
                return $this->db->getConn()->insert_id; // Возвращает ID вставленной компании
            } else {
                return false;
            }
        }
    }

    private function insertPhone($client_id, $phone_number) {
        $sql = "INSERT INTO client_phones (client_id, phone_number)
                VALUES ('$client_id', '$phone_number')";
        $this->db->executeQuery($sql);
    }

    private function deletePhones($client_id) {
        $sql = "DELETE FROM client_phones WHERE client_id = '$client_id'";
        $this->db->executeQuery($sql);
    }

    private function validateData($first_name, $last_name, $email) {
       
        if (empty($first_name) || empty($last_name) || empty($email)) {
            return false;
        }
        return true;
    }

}
?>
