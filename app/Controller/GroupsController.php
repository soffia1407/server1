<?php
namespace app\Controller;

use app\Model\Group;
use Src\View;
use Src\Request;

class GroupsController
{
    public function index(Request $request): string
    {
        $groups = Group::all();
        
        if ($request->method === 'POST') {
            try {
                $group = new Group();
                $group->id = $request->id; // Номер группы
                $group->name = $request->name; // Название
                
                if ($group->save()) {
                    return app()->route->redirect('/groups');
                }
            } catch (\Exception $e) {
                $error = 'Ошибка: ' . $e->getMessage();
            }
        }
        
        return (new View())->render('groups.index', [
            'groups' => $groups,
            'error' => $error ?? null
        ]);
    }
}