<?php $title = 'Сотрудники'; ?>
<div class="admin-container">
    <h2>Управление сотрудниками</h2>

    <h3>Список сотрудников</h3>
    <?php
    $employees = $employees ?? [];
    if (count($employees) > 0): ?>
        <table class="students-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Роль</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $employee->id ?></td>
                    <td><?= htmlspecialchars($employee->login) ?></td>
                    <td><?= htmlspecialchars($employee->name) ?></td>
                    <td><?= $employee->role ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Нет сотрудников</p>
    <?php endif; ?>
</div>