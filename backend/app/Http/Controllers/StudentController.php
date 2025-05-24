<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{   
   public function student(){
     return response()->json(Student::all());
    }

    public function index(Request $request) 
    {
        $query = Student::query(); 

        if ($request->has('search')) { 
            $search = $request->input('search'); 
            $query->where('first_name', 'LIKE', "%{$search}%") 
                  ->orWhere('last_name', 'LIKE', "%{$search}%") 
                  ->orWhere('email_address', 'LIKE', "%{$search}%") 
                  ->orWhere('address', 'LIKE', "%{$search}%") 
                  ->orWhere('age', 'LIKE', "%{$search}%") 
                  ->orWhere('phone_number', 'LIKE', "%{$search}%"); 
        }
        
        $students = $query->get();

        return response()->json($students);
    }

   public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'age' => 'required|integer',
            'email_address' => 'required|email|unique:students,email_address',
            'phone_number' => 'required|string',
            'emergency_contact' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,svg,jpeg|max:2048', // max 2MB
        ]);

        $imgPath = null;
        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('student_photos', 'public');
        }

        $student = Student::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'address' => $validatedData['address'],
            'age' => $validatedData['age'],
            'email_address' => $validatedData['email_address'],
            'phone_number' => $validatedData['phone_number'],
            'emergency_contact' => $validatedData['emergency_contact'] ?? null,
            'photo' => $imgPath,
        ]);

        $student->photo = $student->photo ? asset('storage/' . $student->photo) : null;

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student,
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => "Error",
            'error' => $e->getMessage(),
        ], 500);
    }
}

   public function update(Request $request, $id)
{
    try {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email_address' => 'sometimes|email|unique:students,email_address,' . $id,
            'address' => 'sometimes|string',
            'age' => 'sometimes|integer',
            'phone_number' => 'sometimes|string',
            'emergency_contact' => 'sometimes|string|nullable',
            'photo' => 'nullable|image|mimes:jpg,png,svg,jpeg|max:2048',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $student->update($validatedData);

        // Format photo URL if exists
        $student->photo = $student->photo ? asset('storage/' . $student->photo) : null;

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Update failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}


public function destroy($id)
{
    $student = student::find($id);

    if (!$student) {
        return response()->json(['message' => 'student not found'], 404); 
    }

    $student->delete();

    return response()->json([
        'message' => 'student deleted']);
}
  
}
