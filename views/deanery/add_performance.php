<?php $title = 'Добавление оценок'; ?>
<div class="deanery-container">
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    
    <h2 class="deanery-title">Добавление оценок</h2>
    
    <!-- Форма добавления оценки -->
    <div class="form-container">
        <form method="post" class="student-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Студент:</label>
                    <select name="student_id" class="form-input" required>
                        <option value="">Выберите студента</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student->id ?>">
                                <?= htmlspecialchars($student->last_name . ' ' . $student->first_name) ?>
                                (Группа: <?= $student->studyGroup->name ?? 'Не указана' ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Дисциплина:</label>
                    <select name="discipline_id" class="form-input" required>
                        <option value="">Выберите дисциплину</option>
                        <?php foreach ($disciplines as $discipline): ?>
                            <option value="<?= $discipline->id ?>">
                                <?= htmlspecialchars($discipline->name) ?>
                                (<?= $discipline->hours ?> часов)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Оценка:</label>
                    <select name="grade" class="form-input" required>
                        <option value="">Выберите оценку</option>
                        <option value="5">5 (Отлично)</option>
                        <option value="4">4 (Хорошо)</option>
                        <option value="3">3 (Удовлетворительно)</option>
                        <option value="2">2 (Неудовлетворительно)</option>
                        <option value="0">Не аттестован</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Отработано часов:</label>
                    <input type="number" name="hours" class="form-input" min="0" max="200" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Вид контроля:</label>
                <select name="control_type" class="form-input" required>
                    <option value="экзамен">Экзамен</option>
                    <option value="зачет">Зачет</option>
                    <option value="курсовая">Курсовая работа</option>
                    <option value="практика">Практика</option>
                </select>
            </div>
            
            <button type="submit" class="btn auth-btn">Добавить оценку</button>
        </form>
    </div>
</div>