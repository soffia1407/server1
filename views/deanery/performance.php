<?php $title = 'Успеваемость студента'; ?>
<div class="deanery-container">
    <?php if (isset($student) && $student): ?>
        <h2 class="deanery-title">
            Успеваемость студента: 
            <?= htmlspecialchars($student->last_name . ' ' . $student->first_name . ' ' . ($student->middle_name ?? '')) ?>
        </h2>
        
        <div class="student-info">
            <p><strong>Группа:</strong> 
                <?= $student->studyGroup ? htmlspecialchars($student->studyGroup->name) : 'Не указана' ?>
            </p>
            <p><strong>Дата рождения:</strong> 
                <?= date('d.m.Y', strtotime($student->birth_date)) ?>
            </p>
            <p><strong>Адрес:</strong> 
                <?= htmlspecialchars($student->address) ?>
            </p>
        </div>

        <h3>Оценки и успеваемость</h3>
        
        <?php if ($student->performances && count($student->performances) > 0): ?>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>Дисциплина</th>
                        <th>Оценка</th>
                        <th>Часы</th>
                        <th>Вид контроля</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student->performances as $performance): ?>
                    <tr>
                        <td><?= htmlspecialchars($performance->discipline->name ?? 'Не указана') ?></td>
                        <td class="<?= ($performance->grade ?? 0) >= 3 ? 'good-grade' : 'bad-grade' ?>">
                            <?= $performance->grade ?? 'нет' ?>
                        </td>
                        <td><?= $performance->hours ?? 0 ?></td>
                        <td><?= htmlspecialchars($performance->control_type ?? 'Не указан') ?></td>
                        <td>
                            <a href="#" class="action-link">Изменить</a>
                            <a href="#" class="action-link" style="color: #ff3333;">Удалить</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <p>Нет данных об успеваемости</p>
                <a href="/deanery/performance" class="btn auth-btn">Добавить оценку</a>
            </div>
        <?php endif; ?>

        <div style="margin-top: 2rem;">
            <a href="/deanery/students" class="btn auth-btn">← Назад к списку студентов</a>
        </div>

    <?php else: ?>
        <div class="error-message">
            <p>Студент не найден</p>
            <a href="/deanery/students" class="btn auth-btn">Вернуться к списку студентов</a>
        </div>
    <?php endif; ?>
</div>

<style>
.student-info {
    background: white;
    padding: 1.5rem;
    margin: 1rem 0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.student-info p {
    margin: 0.5rem 0;
    font-size: 1.1rem;
}
.good-grade {
    color: #4CAF50;
    font-weight: bold;
    font-size: 1.2rem;
}
.bad-grade {
    color: #ff3333;
    font-weight: bold;
    font-size: 1.2rem;
}
.no-data {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>