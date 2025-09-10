<?php
namespace app\Controller;

use app\Model\User;
use Src\View;
use Src\Request;

class AdminController
{
    public function addEmployee(Request $request)
    {
        if ($request->method === 'POST') {
            $user = new User();
            $user->login = $request->login;
            $user->password = md5($request->password);
            $user->role = 'employee';
            $user->save();
            
            app()->route->redirect('/admin/employees');
        }
        
        return (new View())->render('admin.add_employee');
    }

    public function employees(Request $request)
{
    // Обработка добавления нового студента
    if ($request->method === 'POST' && isset($request->add_student)) {
        try {
            // Ваш код добавления студента в БД
            $student = new Student();
            $student->create($request->all());
            
            // Редирект на эту же страницу после успешного добавления
            app()->route->redirect('/admin/employees');
            return;
        } catch (Exception $e) {
            // Логирование ошибки
            error_log($e->getMessage());
        }
    }

    // Получение списка студентов
    $students = Student::all();
    $groups = Group::all();

    // Проверка существования файла представления
    $viewPath = dirname(__DIR__, 2) . '/views/admin/employees.php';
    if (!file_exists($viewPath)) {
        throw new Exception("View file not found: " . $viewPath);
    }

    // Рендеринг страницы
    return (new View())->render('admin.employees', [
        'students' => $students,
        'groups' => $groups
    ]);
}
}