<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentTraining;
use App\Models\TrainingSchedule;
use Illuminate\Http\Request;

class OptinoptoutController extends Controller
{
    public function index()
    {
        $schedules = StudentTraining::with(['student', 'trainingSchedule'])->get();
        $students = Student::all();
        $trainings = TrainingSchedule::all();

        return view('opt-in-opt-out', compact('schedules', 'students', 'trainings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_id' => 'required|exists:training_schedules,id',
            'opt_in_at' => 'required|date_format:H:i',
            'opt_out_at' => 'required|date_format:H:i|after:opt_in_at',
        ]);

        // Append the current date to the time
        $optInAt = now()->format('Y-m-d') . ' ' . $request->opt_in_at . ':00';
        $optOutAt = now()->format('Y-m-d') . ' ' . $request->opt_out_at . ':00';

        StudentTraining::create([
            'student_id' => $request->student_id,
            'training_id' => $request->training_id,
            'opt_in_at' => $optInAt,
            'opt_out_at' => $optOutAt,
        ]);

        return redirect()->route('student_time.index')->with('success', 'Training schedule added successfully.');
    }

    public function update(Request $request, StudentTraining $student_time)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_id' => 'required|exists:training_schedules,id',
            'opt_in_at' => 'required|date_format:H:i',
            'opt_out_at' => 'required|date_format:H:i|after:opt_in_at',
        ]);

        $optInAt = now()->format('Y-m-d') . ' ' . $request->opt_in_at . ':00';
        $optOutAt = now()->format('Y-m-d') . ' ' . $request->opt_out_at . ':00';

        $student_time->update([
            'student_id' => $request->student_id,
            'training_id' => $request->training_id,
            'opt_in_at' => $optInAt,
            'opt_out_at' => $optOutAt,
        ]);

        return redirect()->route('student_time.index')->with('success', 'Training schedule updated successfully.');
    }

    public function destroy(StudentTraining $student_time)
    {
        $student_time->delete();

        return redirect()->route('student_time.index')->with('success', 'Training schedule deleted successfully.');
    }
}
