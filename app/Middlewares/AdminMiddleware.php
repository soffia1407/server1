<?php
namespace app\Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            app()->route->redirect('/');
        }
    }
}