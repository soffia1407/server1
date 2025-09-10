<?php
//Путь до директории с конфигурационными файлами
const DIR_CONFIG = '/../config';

//Подключение автозагрузчика composer
require_once dirname(__DIR__) . '/vendor/autoload.php';

//Функция, возвращающая массив всех настроек приложения
function getConfigs(string $path = DIR_CONFIG): array
{
   $settings = [];
   foreach (scandir(__DIR__ . $path) as $file) {
       $name = explode('.', $file)[0];
       if (!empty($name)) {
           $settings[$name] = include __DIR__ . "$path/$file";
       }
   }
   return $settings;
}

//Добавляем подключение файла routes/web.php
require_once dirname(__DIR__, 2) . '/www/routes/web.php';

$app = new Src\Application(new Src\Settings(getConfigs()));

//Функция возвращает глобальный экземпляр приложения
function app() {
   global $app;
   return $app;
}

return $app;
