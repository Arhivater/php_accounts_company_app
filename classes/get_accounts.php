<?php
require_once('Database.php');
require_once('Account.php');

$db = new Database();
$account = new Account($db); // Создание объекта Account

$limit = 10; // лимит аккаунтов на странице
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Текущая страница (из параметров URL)

$accounts = $account->getAccounts($limit, $page); // объект Account для получения аккаунтов

// вставка блока таблицы
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
} else {
    echo "<tr><td colspan='7'>Нет доступных аккаунтов.</td></tr>";
}
?>