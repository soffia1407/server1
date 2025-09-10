<?php
namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
    protected $table = 'study_groups';
    public $timestamps = false;
    
    protected $fillable = ['name', 'course'];
    
    public function students()
    {
        return $this->hasMany(Student::class, 'study_groups_id');
    }
}