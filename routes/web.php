<?php

use Src\Route;

Route::add('/hello', [app\Controller\Site::class, 'hello']);
Route::add('go', [app\Controller\Site::class, 'index']);
Route::add('/', [app\Controller\Site::class, 'index']);
Route::add('/signup', [app\Controller\Site::class, 'signup']);
Route::add('/login', [app\Controller\Site::class, 'login']);
Route::add('/logout', [app\Controller\Site::class, 'logout']);

