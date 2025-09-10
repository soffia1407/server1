<?php $title = 'Успеваемость по группам'; ?>
<div class="deanery-container">
    <h2 class="deanery-title">Успеваемость студентов по группам</h2>
    
    <?php if (isset($groups) && count($groups) > 0): ?>
        <?php foreach ($groups as $group): ?>
            <div class="group-performance-section">
                <h3>Группа: <?= htmlspecialchars($group->name) ?></h3>
                
                <?php if ($group->students && count($group->students) > 0): ?>
                    <?php foreach ($group->students as $student): ?>
                        <div class="student-performance">
                            <h4>
                                <?= htmlspecialchars($student->last_name . ' ' . $student->first_name) ?>
                                <?= $student->middle_name ? htmlspecialchars(' ' . $student->middle_name) : '' ?>
                            </h4>
                            
                            <?php if ($student->performances && count($student->performances) > 0): ?>
                                <table class="performance-table">
                                    <thead>
                                        <tr>
                                            <th>Дисциплина</th>
                                            <th>Оценка</th>
                                            <th>Часы</th>
                                            <th>Вид контроля</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($student->performances as $performance): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($performance->discipline->name) ?></td>
                                                <td class="<?= $performance->grade >= 3 ? 'good-grade' : 'bad-grade' ?>">
                                                    <?= $performance->grade ?: 'нет' ?>
                                                </td>
                                                <td><?= $performance->hours ?></td>
                                                <td><?= htmlspecialchars($performance->control_type) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="no-data">Нет данных об успеваемости</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-data">В группе нет студентов</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-data">Нет данных о группах</p>
    <?php endif; ?>
</div>

<style>
.group-performance-section {
    background: white;
    padding: 1.5rem;
    margin: 1.5rem 0;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.student-performance {
    margin: 1rem 0;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 6px;
}
.performance-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0.5rem;
}
.performance-table th,
.performance-table td {
    padding: 0.5rem;
    border: 1px solid #ddd;
    text-align: left;
}
.performance-table th {
    background-color: #f5f5f5;
}
.good-grade {
    color: #4CAF50;
    font-weight: bold;
}
.bad-grade {
    color: #ff3333;
    font-weight: bold;
}
</style>