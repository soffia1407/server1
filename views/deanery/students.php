<?php $title = 'Управление студентами'; ?>
<div class="deanery-container">
    <?php if (isset($success)): ?>
        <div class="success-message"><?= $success ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    
    <h2 class="deanery-title">Список студентов</h2>
    
    <!-- Форма добавления нового студента -->
    <div class="student-form-container">
        <h3 class="form-title">Добавить нового студента</h3>
        <form method="post" class="student-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Фамилия:</label>
                    <input type="text" name="last_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Имя:</label>
                    <input type="text" name="first_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Отчество:</label>
                    <input type="text" name="middle_name" class="form-input">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Пол:</label>
                    <select name="gender" class="form-input" required>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Дата рождения:</label>
                    <input type="date" name="birth_date" class="form-input" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Адрес прописки:</label>
                <input type="text" name="address" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Группа:</label>
                <select name="study_groups_id" class="form-input" required>
                    <option value="">Выберите группу</option>
                    <?php if (isset($studyGroups) && count($studyGroups) > 0): ?>
                        <?php foreach ($studyGroups as $group): ?>
                            <option value="<?= $group->id ?>">
                                Группа #<?= $group->id ?>: <?= htmlspecialchars($group->name) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Нет доступных групп</option>
                    <?php endif; ?>
                </select>
                <?php if (isset($studyGroups) && count($studyGroups) > 0): ?>
                    <small class="group-hint">Выберите существующую группу из списка</small>
                <?php else: ?>
                    <small class="group-hint" style="color: red;">
                        Внимание: нет доступных групп! Сначала создайте группы в БД.
                    </small>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn auth-btn">Добавить студента</button>
        </form>
    </div>
    
    <!-- Таблица студентов -->
    <?php if (isset($students) && is_iterable($students)): ?>
        <table class="students-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Группа</th>
                    <th>Дата рождения</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($student->last_name . ' ' . $student->first_name . ' ' . ($student->middle_name ?? '')) ?>
                    </td>
                    <td>
                        <?php if ($student->group): ?>
                            <?= htmlspecialchars($student->group->name) ?> (ID: <?= $student->group_id ?>)
                        <?php else: ?>
                            Не указана
                        <?php endif; ?>
                    </td>
                    <td><?= date('d.m.Y', strtotime($student->birth_date)) ?></td>
                    <td>
                        <a href="/deanery/students/<?= $student->id ?>" class="action-link">Успеваемость</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Нет данных о студентах</p>
    <?php endif; ?>
</div>