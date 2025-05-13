<?php

use Src\Route;

Route::add('/hello', ['app\Controller\Site', 'hello']);
Route::add('/go', ['app\Controller\Site', 'index']);
Route::add('/', ['app\Controller\Site', 'index']);
Route::add('/signup', ['app\Controller\Site', 'signup']);
