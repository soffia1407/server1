<?php
$posts = $posts ?? []; // Гарантируем существование переменной
?>
<div class="posts-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h4><?= isset($post->title) ? htmlspecialchars((string)$post->title) : '' ?></h4>
                <p><?= isset($post->content) ? htmlspecialchars((string)$post->content) : '' ?></p>
                <?php if (isset($post->created_at)): ?>
                    <small class="post-date">
                        <?= date('d.m.Y H:i', strtotime($post->created_at)) ?>
                    </small>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>Нет доступных записей</p>
        </div>
    <?php endif; ?>
</div>