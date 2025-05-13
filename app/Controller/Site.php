<?php

namespace app\Controller;

use app\Model\Post;
use Src\View;
use Src\Request;
use app\Model\User;

class Site
{
    public function index(Request $request): string
    {
        // Используем безопасное получение параметра через get()
        $postId = $request->get('id'); // Вернёт null, если id нет
        $posts = $postId ? Post::where('id', $postId)->get() : Post::all();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    // Метод для обработки маршрута /hello
    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    // Метод для обработки маршрута /signup
    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/go'); // Редирект вместо вывода сообщения
        }
        return new View('site.signup');
    }
}