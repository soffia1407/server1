<?php
$title = 'Регистрация';
$auth_page = true;
$message = $message ?? '';
?>
<div class="auth-container">
    <h2 class="auth-title">Регистрация</h2>
    <?php if ($message): ?>
        <div class="error-message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" class="auth-form">
        <div class="form-group">
            <input type="text" name="name" placeholder="Введите имя" class="form-input">
        </div>
        <div class="form-group">
            <input type="text" name="login" placeholder="Введите логин" class="form-input">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Введите пароль" class="form-input">
        </div>
        <button type="submit" class="btn auth-btn">Зарегистрироваться</button>
        <div class="form-footer">
            Уже есть аккаунт? <a href="<?= app()->route->getUrl('/login') ?>" class="form-link">Войдите</a>
        </div>
    </form>
</div>