<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Главная' ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <?php if (isset($auth_page)): ?>
        <link rel="stylesheet" href="/assets/css/auth.css">
    <?php endif; ?>
</head>
<body>
    <header class="header">
        <nav class="main-nav">
            <?php if (app()->auth::check()): ?>                                                                   
                <?php if (app()->auth::user()->role === 'admin'): ?>             
                    <a href="/admin/employees" class="nav-link">Сотрудники</a>
                    <a href="/admin/add-employee" class="nav-link">Добавить сотрудника</a>
                <?php else: ?>                   
                    <a href="/hello" class="nav-link">Главная</a>
                    <a href="/deanery/students" class="nav-link">Студенты</a>
                <?php endif; ?>
                <a href="/logout" class="nav-link">Выход</a>
            <?php else: ?>
                <a href="/" class="nav-link">Главная</a>
                <a href="/login" class="nav-link">Вход</a>
                <a href="/signup" class="nav-link">Регистрация</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main class="main-content">
        <?= $content ?? '' ?>
    </main>
</body>
</html>