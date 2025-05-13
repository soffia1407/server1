<?php

use Src\Route;

// Главная страница
Route::add(['GET', 'POST'], '/', [app\Controller\Site::class, 'index']);
// Страница hello с middleware auth
Route::add(['GET', 'POST'], '/hello', [app\Controller\Site::class, 'hello'])->middleware('auth');
// Роут go
Route::add(['GET', 'POST'], '/go', [app\Controller\Site::class, 'index']);
// Авторизация
Route::add(['GET', 'POST'], '/login', [app\Controller\Site::class, 'login']);
// Регистрация
Route::add(['GET', 'POST'], '/signup', [app\Controller\Site::class, 'signup']);
// Выход
Route::add(['GET', 'POST'], '/logout', [app\Controller\Site::class, 'logout']);