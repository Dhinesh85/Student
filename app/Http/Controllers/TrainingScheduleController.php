<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSchedule;
use App\Models\Course;

class TrainingScheduleController extends Controller
{
    /**
     * Display a listing of the training schedules.
     */
    public function index()
    {
        $schedules = TrainingSchedule::with('course')->latest()->get();
        $courses = Course::all(); 
        return view('trainingschedules', compact('schedules', 'courses'));
    }

    /**
     * Store a newly created training schedule.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        TrainingSchedule::create([
            'course_id' => $request->course_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Training schedule added successfully.');
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(TrainingSchedule $trainingSchedule)
    {
        return response()->json($trainingSchedule);
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, TrainingSchedule $trainingSchedule)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $trainingSchedule->update([
            'course_id' => $request->course_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Training schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     */
    public function destroy(TrainingSchedule $trainingSchedule)
    {
        $trainingSchedule->delete();
        return redirect()->back()->with('success', 'Training schedule deleted successfully.');
    }
}
