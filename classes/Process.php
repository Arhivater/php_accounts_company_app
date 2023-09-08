<?php
require_once('Database.php');
require_once('Account.php');

$db = new Database();
$account = new Account($db);

// обновление таблицы с аккаунтами
function updateTable($db, $limit, $page)
{
    $accounts = $account->getAccounts($limit, $page); // получаю аккаунты из бдшки

    if ($accounts) {
        foreach ($accounts as $acc) {
            echo "<tr>";
            echo "<td>{$acc['first_name']}</td>";
            echo "<td>{$acc['last_name']}</td>";
            echo "<td>{$acc['email']}</td>";
            echo "<td>{$acc['company_name']}</td>";
            echo "<td>{$acc['position']}</td>";
            echo "<td>{$acc['phones']}</td>";
            echo "<td><a href='edit.php?id={$acc['client_id']}'>Редактировать</a> | <a href='#' class='delete-account' data-account-id='{$acc['client_id']}'>Удалить</a></td>";
            echo "</tr>";
        }
    }
    
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $client_id = $_GET['id'];
    if ($account->deleteClient($client_id)) {
        // Успешно удалено, перенаправление или вывод сообщения об успехе
        header('Location: index.php');
        exit();
    } else {
        // Обработка ошибки при удалении
        echo "Ошибка при удалении аккаунта.";
    }
}


if (isset($_POST['add_account'])) {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'company_name' => $_POST['company_name'],
        'position' => $_POST['position'],
        'phone1' => $_POST['phone1'],
        'phone2' => $_POST['phone2'],
        'phone3' => $_POST['phone3']
    ];

    if ($account->addClient($data)) {
        header('Location: index.php');
        exit();
    } else {
        // Обработка ошибки при добавлении
        echo "Ошибка при добавлении аккаунта.";
        return "Error: " . $e->getMessage();
    }
}

// Обработка перелистывания страниц таблицы
$limit = 10; // Количество аккаунтов на странице
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Текущая страница (из параметров URL)

// обновление таблицы с аккаунтами
updateTable($db, $limit, $page);

?>
