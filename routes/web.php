<?php
use Src\Route;

// Главная страница
Route::add(['GET', 'POST'], '/', [app\Controller\Site::class, 'index']);
Route::add(['GET', 'POST'], '/hello', [app\Controller\Site::class, 'hello'])->middleware('auth'); // Страница hello с middleware auth
Route::add(['GET', 'POST'], '/go', [app\Controller\Site::class, 'index']);

// Авторизация/Регистрация/Выход
Route::add(['GET', 'POST'], '/login', [app\Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/signup', [app\Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/logout', [app\Controller\Site::class, 'logout']);

// Админские маршруты
Route::add('GET', '/admin', [app\Controller\AdminController::class, 'dashboard'])->middleware('admin');
Route::add(['GET', 'POST'], '/admin/add-employee', [app\Controller\AdminController::class, 'addEmployee'])->middleware('admin');
Route::add('GET', '/admin/employees', [app\Controller\AdminController::class, 'employees'])->middleware('admin');

// Маршруты деканата
Route::add(['GET', 'POST'], '/deanery/students', [app\Controller\DeaneryController::class, 'students'])->middleware('employee');
Route::add('GET', '/deanery/students/{id}', [app\Controller\DeaneryController::class, 'studentPerformance'])->middleware('employee');
