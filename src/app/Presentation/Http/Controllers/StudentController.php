<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Models\Student;
use App\Application\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    private StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(Request $request): JsonResponse
    {
        $students = $this->studentService->getStudents(
            $request->query('per_page', 10),
            $request->query('q')
        );

        return response()->json($students);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ime'    => 'required|string|max:30',
            'prezime'=> 'required|string|max:30',
            'godina' => 'required|integer|min:1|max:4',
        ]);

        $student = $this->studentService->createStudent($validated);
        return response()->json($student, 201);
    }

    public function show(int $id): JsonResponse
    {
        $student = $this->studentService->getStudentById($id);
        return response()->json($student);
    }

    public function update(Request $request, Student $student): JsonResponse
    {
        $validated = $request->validate([
            'ime'    => 'sometimes|string|max:30',
            'prezime'=> 'sometimes|string|max:30',
            'godina' => 'sometimes|integer|min:1|max:4',
        ]);

        $updated = $this->studentService->updateStudent($student, $validated);
        return response()->json($updated);
    }

    public function destroy(Student $student): JsonResponse
    {
        $this->studentService->deleteStudent($student);
        return response()->json(null, 204);
    }
}
