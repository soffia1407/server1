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
            <a href="<?= app()->route->getUrl('/') ?>" class="nav-link">Главная</a>
            <?php if (!app()->auth::check()): ?>
                <a href="<?= app()->route->getUrl('/login') ?>" class="nav-link">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>" class="nav-link">Регистрация</a>
            <?php else: ?>
                <a href="<?= app()->route->getUrl('/logout') ?>" class="nav-link">Выход (<?= app()->auth::user()->name ?>)</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main class="main-content">
        <?= $content ?? '' ?>
    </main>
</body>
</html>