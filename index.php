<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>тестовое зазадание</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.0.js"></script> // да я скачал а не подключал jquery по ссылке чтобы xampp на localhost по настройкам доступа не парил мне мозг.
    <script src="js/script.js"></script>
</head>
<body>
    <h1>тестовое зазадание</h1>
    <form action="process.php" method="post">
        <label for="first_name">Имя:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Фамилия:</label>
        <input type="text" id="last_name" name="last_name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="company_name">Компания:</label>
        <input type="text" id="company_name" name="company_name"><br>
        
        <label for="position">Должность:</label>
        <input type="text" id="position" name="position"><br>
        
        <label for="phone1">Телефон 1:</label>
        <input type="tel" id="phone1" name="phone1"><br>
        
        <label for="phone2">Телефон 2:</label>
        <input type="tel" id="phone2" name="phone2"><br>
        
        <label for="phone3">Телефон 3:</label>
        <input type="tel" id="phone3" name="phone3"><br>
        
        <input class="addButton" type="button" id="addAccountForm" value="Добавить">
    </form>

    <h2>Список аккаунтов</h2>
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Компания</th>
                <th>Должность</th>
                <th>Телефоны</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody id="accountTable">
            <!-- таблица аккаунтов через AJAX -->
        </tbody>
    </table>

    <div class="pagination">
        <button id="prevPage">Назад</button>
        <span id="currentPage" class="paginationText">1</span>
        <button id="nextPage">Вперед</button>
    </div>

</body>
</html>