<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display student list page
     */
    public function index()
    {
        return view('students.index');
    }

    /**
     * AJAX: fetch students with sorting & pagination
     */
    public function list(Request $request)
    {
        $query = Student::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            $query->orderBy(
                $request->sort,
                $request->direction ?? 'asc'
            );
        }

        $students = $query->paginate(5);

        return view('students.partials.table', compact('students'))->render();
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1',
            'mark' => 'required|integer|min:0|max:100',
        ]);

        $validated['result'] = $validated['mark'] >= 40 ? 'Pass' : 'Fail';

        Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully'
        ]);
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1',
            'mark' => 'required|integer|min:0|max:100',
        ]);

        $validated['result'] = $validated['mark'] >= 40 ? 'Pass' : 'Fail';

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully'
        ]);
    }

    /**
     * Remove the specified student
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
