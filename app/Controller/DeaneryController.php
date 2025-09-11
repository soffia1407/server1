<?php
namespace app\Controller;

use app\Model\Student;
use app\Model\StudyGroup;
use app\Model\Discipline;
use app\Model\Performance;
use app\Model\Group;
use Src\View;
use Src\Request;

class DeaneryController
{
    public function students(Request $request): string
    {
        // Получаем все группы из БД
        $studyGroups = StudyGroup::all();

        // Получаем всех студентов с их группами
        $students = Student::with('studyGroup')->get();

        // Если форма отправлена (POST)
        if ($request->method === 'POST') {
            try {
                // Создаём нового студента
                $student = new Student();
                $student->last_name = $request->last_name;
                $student->first_name = $request->first_name;
                $student->middle_name = $request->middle_name ?? null;
                $student->gender = $request->gender;
                $student->birth_date = $request->birth_date;
                $student->address = $request->address;
                $student->study_groups_id = $request->study_groups_id;

                if ($student->save()) {
                    return app()->route->redirect('/deanery/students');
                }
            } catch (\Exception $e) {
                return (new View())->render('deanery.students', [
                    'students' => $students,
                    'studyGroups' => $studyGroups,
                    'error' => 'Ошибка: ' . $e->getMessage()
                ]);
            }
        }

        return (new View())->render('deanery.students', [
            'students' => $students,
            'studyGroups' => $studyGroups
        ]);
    }

    public function studentPerformance($id, Request $request): string
    {
        $student = Student::with(['studyGroup', 'performances.discipline'])
                        ->where('id', $id)
                        ->first();

        return (new View())->render('deanery.performance', [
            'student' => $student
        ]);
    }

    public function disciplines(Request $request): string
    {
        $disciplines = Discipline::all();
        
        if ($request->method === 'POST') {
            try {
                $discipline = new Discipline();
                $discipline->name = $request->name;
                $discipline->hours = $request->hours;
                $discipline->control_type = $request->control_type;
                
                if ($discipline->save()) {
                    return app()->route->redirect('/deanery/disciplines');
                }
            } catch (\Exception $e) {
                $error = 'Ошибка: ' . $e->getMessage();
            }
        }
        
        return (new View())->render('deanery.disciplines', [
            'disciplines' => $disciplines,
            'error' => $error ?? null
        ]);
    }

    public function addPerformance(Request $request): string
    {
        $students = Student::all();
        $disciplines = Discipline::all();
        
        if ($request->method === 'POST') {
            try {
                $performance = new Performance();
                $performance->student_id = $request->student_id;
                $performance->discipline_id = $request->discipline_id;
                $performance->grade = $request->grade;
                $performance->hours = $request->hours;
                $performance->control_type = $request->control_type;
                
                if ($performance->save()) {
                    return app()->route->redirect('/deanery/performance');
                }
            } catch (\Exception $e) {
                $error = 'Ошибка: ' . $e->getMessage();
            }
        }
        
        return (new View())->render('deanery.add_performance', [
            'students' => $students,
            'disciplines' => $disciplines,
            'error' => $error ?? null
        ]);
    }

    public function attachDisciplineToGroup(Request $request): string
    {
       $groups = Group::all();
       $disciplines = Discipline::all();
       
       if ($request->method === 'POST') {
           try {
               $group = Group::find($request->group_id);
               $group->disciplines()->attach($request->discipline_id);
               
               return app()->route->redirect('/deanery/group-disciplines');
           } catch (\Exception $e) {
               $error = 'Ошибка: ' . $e->getMessage();
           }
       }
       
       return (new View())->render('deanery.attach_discipline', [
           'groups' => $groups,
           'disciplines' => $disciplines,
           'error' => $error ?? null
       ]);
    }

    public function groupPerformance(Request $request): string
    {
        $groups = Group::with(['students.performances.discipline'])->get();
        
        return (new View())->render('deanery.group_performance', [
            'groups' => $groups
        ]);
    }
}