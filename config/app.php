<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Класс пользователя
    'identity' => \app\Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \app\Middlewares\AuthMiddleware::class,
        'admin' => \app\Middlewares\AdminMiddleware::class,
        'employee' => \app\Middlewares\EmployeeMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
    ],
    'validators' => [
       'required' => \Validators\RequireValidator::class,
       'unique' => \Validators\UniqueValidator::class
    ],
    'routeAppMiddleware' => [
       'trim' => \Middlewares\TrimMiddleware::class,
       'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],

];
