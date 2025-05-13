<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация нового пользователя</title>
</head>
<body>
    <h2>Регистрация нового пользователя</h2>
    <h3><?= $message ?? ''; ?></h3>
    <form method="post">
       <label>Имя <input type="text" name="name"></label>
       <label>Логин <input type="text" name="login"></label>
       <label>Пароль <input type="password" name="password"></label>
       <button>Зарегистрироваться</button>
    </form>
</body>
</html>