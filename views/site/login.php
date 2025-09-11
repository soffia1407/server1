<?php
$title = 'Авторизация';
$auth_page = true;
$message = $message ?? '';
?>
<div class="auth-container">
    <h2 class="auth-title">Авторизация</h2>
    <?php if ($message): ?>
        <div class="error-message"><?= $message ?></div>
    <?php endif; ?>

    <?php if (!app()->auth::check()): ?>
    <form method="post" class="auth-form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="form-group">
            <input type="text" name="login" placeholder="Введите логин" class="form-input">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Введите пароль" class="form-input">
        </div>
        <button type="submit" class="btn auth-btn">Войти</button>
        <div class="form-footer">
            Нет аккаунта? <a href="<?= app()->route->getUrl('/signup') ?>" class="form-link">Зарегистрируйтесь</a>
        </div>
    </form>
    <?php endif; ?>
</div>