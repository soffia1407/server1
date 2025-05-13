<?php
return [
   //Класс аутентификации
   'auth' => \Src\Auth\Auth::class,
   //Клас пользователя
   'identity'=>\app\Model\User::class,
   //Классы для middleware
   'routeMiddleware' => [
   'auth' => app\Middlewares\AuthMiddleware::class,
]

];
