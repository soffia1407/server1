<?php

namespace app\Controller;

use app\Model\Post;
use Src\View;

class Site
{
    // Метод для обработки главной страницы и маршрута /go
   public function index(): string
   {
       $posts = Post::all();
       return (new View())->render('site.post', ['posts' => $posts]);
   }

   // Метод для обработки маршрута /hello
   public function hello(): string
   {
       return new View('site.hello', ['message' => 'hello working']);
   }
}
