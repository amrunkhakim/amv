<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $course->modules()->create($validated);

        return back()->with('success', 'Module added successfully.');
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $module->update($validated);

        return back()->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return back()->with('success', 'Module deleted successfully.');
    }
}
