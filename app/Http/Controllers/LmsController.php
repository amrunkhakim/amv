<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Setting;
use Illuminate\Http\Request;

class LmsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $courses = Course::where('is_published', true)->withCount('modules')->get();
        
        $seo = [
            'title' => 'Nuansa Coding Academy | Pelatihan IT Terapan',
            'schema' => \App\Helpers\SeoEngine::generateDynamicSchema()
        ];

        return view('academy.index', compact('settings', 'courses', 'seo'));
    }

    public function show(Course $course)
    {
        if (!$course->is_published) {
            abort(404);
        }
        $settings = Setting::pluck('value', 'key')->all();
        $course->load('modules.lessons');

        $seo = [
            'title' => $course->title . ' | Nuansa Coding Academy',
            'schema' => \App\Helpers\SeoEngine::generateDynamicSchema()
        ];

        return view('academy.show', compact('settings', 'course', 'seo'));
    }

    public function enroll(Request $request, Course $course)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu untuk mendaftar kursus.');
        }

        $user = auth()->user();

        // Check if already enrolled
        if ($user->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->route('portal.academy.learn', $course)->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        $user->enrollments()->create([
            'course_id' => $course->id,
            'status' => 'active',
            'progress_percent' => 0,
            'enrolled_at' => now(),
        ]);

        return redirect()->route('portal.academy.learn', $course)->with('success', 'Pendaftaran berhasil! Selamat belajar.');
    }
}
