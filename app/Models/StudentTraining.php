<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTraining extends Model {
    use HasFactory;

    protected $fillable = ['student_id', 'training_id', 'opt_in_at', 'opt_out_at'];

    // Relationship with Student
    public function student() {
        return $this->belongsTo(Student::class);
    }

    // Relationship with Training Schedule
    public function trainingSchedule() {
        return $this->belongsTo(TrainingSchedule::class, 'training_id');
    }
}
