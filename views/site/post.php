<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список статей</title>
</head>
<body>
    <h1>Список статей</h1>
        <ol>
            <?php
            foreach ($posts as $post) {
                echo '<li>' . $post->title . '</li>';
            }
            ?>
        </ol>
</body>
</html>