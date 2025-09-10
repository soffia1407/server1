<?php $title = 'Прикрепление дисциплин к группам'; ?>
<div class="deanery-container">
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    
    <h2 class="deanery-title">Прикрепление дисциплин к группам</h2>
    
    <!-- Форма прикрепления дисциплины -->
    <div class="form-container">
        <form method="post" class="student-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Группа:</label>
                    <select name="group_id" class="form-input" required>
                        <option value="">Выберите группу</option>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->id ?>">
                                Группа #<?= $group->id ?>: <?= htmlspecialchars($group->name) ?>
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
            
            <button type="submit" class="btn auth-btn">Прикрепить дисциплину</button>
        </form>
    </div>
    
    <!-- Список прикрепленных дисциплин -->
    <div style="margin-top: 2rem;">
        <h3>Текущие прикрепления</h3>
        <?php if (isset($groups) && count($groups) > 0): ?>
            <?php foreach ($groups as $group): ?>
                <?php if ($group->disciplines && count($group->disciplines) > 0): ?>
                    <div class="group-section">
                        <h4>Группа: <?= htmlspecialchars($group->name) ?></h4>
                        <ul>
                            <?php foreach ($group->disciplines as $discipline): ?>
                                <li>
                                    <?= htmlspecialchars($discipline->name) ?>
                                    (<?= $discipline->hours ?> часов, <?= $discipline->control_type ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-data">Нет данных о прикрепленных дисциплинах</p>
        <?php endif; ?>
    </div>
</div>

<style>
.group-section {
    background: white;
    padding: 1rem;
    margin: 1rem 0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.group-section h4 {
    margin-bottom: 0.5rem;
    color: #333;
}
.group-section ul {
    list-style: none;
    padding: 0;
}
.group-section li {
    padding: 0.3rem 0;
    border-bottom: 1px solid #eee;
}
</style>