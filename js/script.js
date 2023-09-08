$(document).ready(function () {
    var currentPage = 1; // по умолчанию стр. 1
    var limit = 10; // лимит аккаунтов на странице

    // Функция для загрузки аккаунтов по указанной странице
    function loadAccounts(page) {
        $.ajax({
            url: 'classes/get_accounts.php', // Имя файла для получения аккаунтов
            type: 'GET',
            data: { page: page, limit: limit },
            success: function (response) {
                $('#accountTable').html(response);
            }
        });
    }

    // Функция для обновления таблицы аккаунтов после действия (добавление, перелистывание)
    function updateAccountTable() {
        loadAccounts(currentPage);
        document.getElementById('currentPage').textContent = currentPage;
    }

    // Обработчик события для кнопки "Вперед"
    $('#nextPage').click(function () {
        currentPage++;
        updateAccountTable();
    });

    // Обработчик события для кнопки "Назад"
    $('#prevPage').click(function () {
        if (currentPage > 1) {
            currentPage--;
            updateAccountTable();
        }
    });

    // Обработчик события для кнопки "Добавить"
    $('#addAccountForm').click(function () {
        var formData = {
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            company_name: $('#company_name').val(),
            position: $('#position').val(),
            phone1: $('#phone1').val(),
            phone2: $('#phone2').val(),
            phone3: $('#phone3').val(),
            add_account: 1
        };

        $.ajax({
            url: 'classes/process.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response === "success") {
                    alert("Аккаунт успешно добавлен.");
                    // Очистка полей формы
                    $("#first_name, #last_name, #email, #company_name, #position, #phone1, #phone2, #phone3").val("");
                } else {
                    alert("Ошибка при добавлении аккаунта.");
                }
            }
        });
        updateAccountTable();
    });

    // Обработчик события для кнопки "Удалить"
    $('#accountTable').on('click', 'a.delete-account', function (e) {
        e.preventDefault();
        var accountId = $(this).data('account-id');

        if (confirm('Вы уверены, что хотите удалить этот аккаунт?')) {
            $.ajax({
                url: 'classes/process.php?action=delete&id=' + accountId,
                type: 'GET',
                success: function (response) {
                    if (response === "success" || "Ошибка: объект account равен null.") {
                        $('#accountTable').html(response);
                        alert("Аккаунт успешно удален");
                        loadAccounts(currentPage); // Загрузка аккаунтов после удаления
                    } else {
                        alert("Ошибка при удалении аккаунта");
                    }
                }
            });
        }
    });

    $('#addAccountForm' || 'a.delete-account').click(function () {
        updateAccountTable();
    });

    // Загрузка аккаунтов при загрузке страницы
    loadAccounts(currentPage);
});

