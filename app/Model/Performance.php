<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $table = 'performances';
    
    // Отключаем временные метки (created_at, updated_at)
    public $timestamps = false;
    
    protected $fillable = [
        'student_id',
        'discipline_id',
        'grade',
        'hours',
        'control_type'
    ];
    
    // Связь: оценка принадлежит студенту
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    // Связь: оценка принадлежит дисциплине
    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
}