<?php
class Database {
    private $host = "localhost";
    private $username = 'Arhivater$admin';
    private $password = '%php$Arhivater#Admin';
    private $dbname = "testtask"; // имя бд testtask
    
    private $conn;

    public function __construct() {
        // Инициализация соединения с базой данных
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Проверка на ошибку соединения
        if ($this->conn->connect_error) {
            die("Ошибка соединения с базой данных: " . $this->conn->connect_error);
        }
    }

    public function getConn() {
        return $this->conn;
    }

    public function executeQuery($sql) {
        return $this->conn->query($sql);
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }
    public function close() {
        $this->conn->close();
    }
}
?>



