<?php

namespace app\Controller;

use app\Model\Post;
use Src\View;
use Src\Request;
use app\Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        try {
            $posts = Post::all(); // Всегда получаем все посты
            return (new View())->render('site.post', ['posts' => $posts]);
        } catch (Exception $e) {
            // Логирование ошибки при необходимости
            return (new View())->render('site.post', ['posts' => []]);
        }
    }

    public function hello(): string
    {
        return (new View())->render('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
       if ($request->method === 'POST') {
    
           $validator = new Validator($request->all(), [
               'name' => ['required'],
               'login' => ['required', 'unique:users,login'],
               'password' => ['required']
           ], [
               'required' => 'Поле :field пусто',
               'unique' => 'Поле :field должно быть уникально'
           ]);
       
           if($validator->fails()){
               return new View('site.signup',
                   ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
           }
       
           if (User::create($request->all())) {
               app()->route->redirect('/login');
           }
       }
       return new View('site.signup');
    }


    public function login(Request $request): string
    {
        $message = ''; // Сохраняем переменную для сообщения об ошибке
        
        if ($request->method === 'POST') {
            if (Auth::attempt($request->all())) {
                // Редирект в зависимости от роли
                if (Auth::user()->role === 'admin') {
                    app()->route->redirect('/admin/employees');
                } else {
                    app()->route->redirect('/hello');
                }
            }
            $message = 'Неправильные логин или пароль'; // Сообщение об ошибке
        }
        
        return (new View())->render('site.login', ['message' => $message]);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }
}
