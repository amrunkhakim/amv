<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index()
    {
        $enrollments = auth()->user()->enrollments()->with('course')->orderBy('enrolled_at', 'desc')->get();
        return view('portal.academy.index', compact('enrollments'));
    }

    public function learn(Course $course, Lesson $lesson = null)
    {
        $user = auth()->user();
        $enrollment = $user->enrollments()->where('course_id', $course->id)->firstOrFail();

        $course->load(['modules.lessons' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }]);

        if (!$lesson) {
            $lesson = $course->modules->first()->lessons->first();
        }

        // Security: Ensure lesson belongs to course
        if ($lesson && $lesson->module->course_id !== $course->id) {
            abort(404);
        }

        return view('portal.academy.learn', compact('course', 'lesson', 'enrollment'));
    }
}
