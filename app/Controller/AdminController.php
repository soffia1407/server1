<?php
namespace app\Controller;

use app\Model\User;
use app\Model\Student;
use app\Model\Group;
use Src\View;
use Src\Request;

class AdminController
{
    public function addEmployee(Request $request)
    {
        if ($request->method === 'POST') {
            $user = new User();
            $user->name = $request->name; 
            $user->login = $request->login;
            $user->password = md5($request->password);
            $user->role = 'employee';
            $user->save();
            
            app()->route->redirect('/admin/employees');
        }
        
        return (new View())->render('admin.addEmployee'); 
    }

    public function employees(Request $request)
    {
        $students = Student::all();
        $groups = Group::all();
        $employees = User::where('role', 'employee')->get(); 

        return (new View())->render('admin.employees', [
            'students' => $students,
            'groups' => $groups,
            'employees' => $employees
        ]);
    }
}