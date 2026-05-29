<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string|url',
            'sort_order' => 'required|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $module->lessons()->create($validated);

        return back()->with('success', 'Lesson added successfully.');
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string|url',
            'sort_order' => 'required|integer',
        ]);

        if ($validated['title'] !== $lesson->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $lesson->update($validated);

        return back()->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'Lesson deleted successfully.');
    }
}
