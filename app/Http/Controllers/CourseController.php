<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('course', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    public function show(Course $course)
    {
        return view('course', compact('course'));
    }

    public function edit(Course $course)

    {
        $courses = Course::all();
        return view('course', compact('course','courses'));
    }

    public function update(Request $request, $id)
    {
        
        $course = Course::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
    

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
