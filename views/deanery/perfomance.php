<?php $title = 'Успеваемость студента'; ?>
<div class="performance-container">
    <h2>Успеваемость студента: <?= htmlspecialchars($student->last_name.' '.$student->first_name.' '.$student->middle_name) ?></h2>
    <p>Группа: <?= htmlspecialchars($student->group->name) ?></p>
    
    <table class="performance-table">
        <thead>
            <tr>
                <th>Дисциплина</th>
                <th>Часы</th>
                <th>Вид контроля</th>
                <th>Оценка</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($student->performances as $performance): ?>
            <tr>
                <td><?= htmlspecialchars($performance->discipline->name) ?></td>
                <td><?= $performance->hours ?></td>
                <td><?= htmlspecialchars($performance->control_type) ?></td>
                <td><?= $performance->score ?? 'нет' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>