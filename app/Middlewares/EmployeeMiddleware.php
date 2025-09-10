<?php
namespace app\Middlewares;

use Src\Auth\Auth;
use Src\Request;

class EmployeeMiddleware
{
    public function handle(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'employee') {
            app()->route->redirect('/');
        }
    }
}