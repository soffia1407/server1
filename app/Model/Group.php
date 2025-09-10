<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'study_groups';
    public $timestamps = false;
    
    protected $fillable = [
        'id', // Будем использовать как номер группы
        'name' // Название специальности
    ];
    
    public function students()
    {
        return $this->hasMany(Student::class, 'study_groups_id');
    }

    public function disciplines()
    {
       return $this->belongsToMany(Discipline::class, 'discipline_group', 'group_id', 'discipline_id');
    }
}
