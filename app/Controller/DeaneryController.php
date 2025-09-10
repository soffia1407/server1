<?php
namespace app\Controller;

use app\Model\Student;
use app\Model\StudyGroup;
use app\Model\Discipline;
use app\Model\Performance;
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
                $student->study_groups_id = $request->study_groups_id; // Используем study_groups_id

                if ($student->save()) {
                    // После успешного сохранения обновляем список студентов
                    $students = Student::with('studyGroup')->get();

                    // Перенаправляем на ту же страницу
                    return app()->route->redirect('/deanery/students');
                }
            } catch (\Exception $e) {
                // Если ошибка — показываем её пользователю
                return (new View())->render('deanery.students', [
                    'students' => $students,
                    'studyGroups' => $studyGroups,
                    'error' => 'Ошибка: ' . $e->getMessage()
                ]);
            }
        }

        // Рендерим страницу (GET-запрос)
        return (new View())->render('deanery.students', [
            'students' => $students,
            'studyGroups' => $studyGroups // Передаём группы в шаблон
        ]);
    }

    // Страница успеваемости конкретного студента
    public function studentPerformance(Request $request, $id): string
    {
        $student = Student::with(['group', 'performances.discipline'])
                        ->where('id', $id)
                        ->first();
        
        return (new View())->render('deanery.performance', [
            'student' => $student
        ]);
    }
}