<?php
$title = 'Добавление сотрудника';
?>
<div class="form-container">
    <h2>Добавить сотрудника деканата</h2>
    <?php if (isset($message)): ?>
        <div class="error-message"><?= $message ?></div>
    <?php endif; ?>
    
    <form method="post" class="employee-form">
        <div class="form-group">
            <label>Логин:</label>
            <input type="text" name="login" required>
        </div>
        <div class="form-group">
            <label>Пароль:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="submit-btn">Добавить</button>
    </form>
</div>