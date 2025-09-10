<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $table = 'disciplines';
    
    // Отключаем временные метки (created_at, updated_at)
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'hours', 
        'control_type'
    ];
    
    // Связь: у дисциплины много оценок (успеваемости)
    public function performances()
    {
        return $this->hasMany(Performance::class, 'discipline_id');
    }
    
    // Связь: дисциплина может принадлежать многим группам (если нужно)
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'discipline_group', 'discipline_id', 'group_id');
    }
}