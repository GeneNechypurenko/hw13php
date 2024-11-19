<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px; margin: 0 auto;">
    <h2 class="text-center">Регистрация</h2>
    <form id="registerForm" action="register.php" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" required>
            <span id="loginMessage" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#login').on('input', function() {
            var login = $(this).val();

            if (login.length > 0) {
                $.ajax({
                    url: 'check_login.php',
                    method: 'POST',
                    data: { login: login },
                    success: function(response) {
                        if (response === 'available') {
                            $('#loginMessage').text('Логин доступен').removeClass('text-danger').addClass('text-success');
                        } else {
                            $('#loginMessage').text('Этот логин уже занят').removeClass('text-success').addClass('text-danger');
                        }
                    }
                });
            } else {
                $('#loginMessage').text('');
            }
        });

        $('#registerForm').on('submit', function(event) {
            event.preventDefault();

            if ($('#loginMessage').hasClass('text-danger')) {
                alert('Исправьте ошибки в логине перед отправкой формы.');
                return;
            }

            $.ajax({
                url: 'register.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    $('#registerForm')[0].reset();
                    $('#loginMessage').text('');
                },
                error: function() {
                    alert('Ошибка при регистрации. Попробуйте еще раз.');
                }
            });
        });
    });
</script>

</body>
</html>
