<?php $title = 'Управление дисциплинами'; ?>
<div class="deanery-container">
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    
    <h2 class="deanery-title">Список дисциплин</h2>
    
    <!-- Форма добавления новой дисциплины -->
    <div class="form-container">
        <h3 class="form-title">Добавить новую дисциплину</h3>
        <form method="post" class="student-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Название дисциплины:</label>
                    <input type="text" name="name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Количество часов:</label>
                    <input type="number" name="hours" class="form-input" required min="1">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Вид контроля:</label>
                <select name="control_type" class="form-input" required>
                    <option value="экзамен">Экзамен</option>
                    <option value="зачет">Зачет</option>
                    <option value="курсовая">Курсовая работа</option>
                    <option value="диплом">Дипломный проект</option>
                </select>
            </div>
            
            <button type="submit" class="btn auth-btn">Добавить дисциплину</button>
        </form>
    </div>
    
    <!-- Таблица дисциплин -->
    <?php if (isset($disciplines) && count($disciplines) > 0): ?>
        <table class="students-table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Часы</th>
                    <th>Вид контроля</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($disciplines as $discipline): ?>
                <tr>
                    <td><?= htmlspecialchars($discipline->name) ?></td>
                    <td><?= $discipline->hours ?></td>
                    <td><?= htmlspecialchars($discipline->control_type) ?></td>
                    <td>
                        <a href="#" class="action-link">Редактировать</a>
                        <a href="#" class="action-link" style="color: #ff3333;">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Нет данных о дисциплинах</p>
    <?php endif; ?>
</div>