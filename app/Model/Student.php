<?php
namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    public $timestamps = false;
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'birth_date',
        'address',
        'study_groups_id'
    ];

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class, 'study_groups_id');
    }
}
