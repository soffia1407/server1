<?php
namespace app\Controller;

use Src\View;

class Site
{
    // Метод для обработки главной страницы и маршрута /go
    public function index(): string
    {
        return (new View())->render('site.hello', ['message' => 'index working']);
    }

    // Метод для обработки маршрута /hello
    public function hello(): string
    {
        return (new View())->render('site.hello', ['message' => 'hello working']);
    }
}
