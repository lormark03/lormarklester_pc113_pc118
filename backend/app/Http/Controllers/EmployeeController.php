<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

   public function employee(){
      return response()->json(Employee::all());
    }

    public function index(Request $request)
    {
        $query = Employee::query();


        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'LIKE', "%{$search}%")
            ->orWhere('last_name', 'LIKE', "%{$search}%")
            ->orWhere('email_address', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('age', 'LIKE', "%{$search}%")
            ->orWhere('phone_number', 'LIKE', "%{$search}%");
        }

        $employees = $query->get();

        return response()->json($employees);
    }

 public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'age' => 'required|integer',
            'email_address' => 'required|email|unique:employees,email_address',
            'phone_number' => 'required|string',
            'emergency_contact' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,svg,jpeg|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('employee_photos', 'public');
        }

        $employee = Employee::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'address' => $validatedData['address'],
            'age' => $validatedData['age'],
            'email_address' => $validatedData['email_address'],
            'phone_number' => $validatedData['phone_number'],
            'emergency_contact' => $validatedData['emergency_contact'] ?? null,
            'photo' => $imgPath,
        ]);

        $employee->photo = $employee->photo ? asset('storage/' . $employee->photo) : null;

        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee,
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
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email_address' => 'sometimes|email|unique:employees,email_address,' . $id,
            'address' => 'sometimes|string',
            'age' => 'sometimes|integer',
            'phone_number' => 'sometimes|string',
            'emergency_contact' => 'sometimes|string|nullable',
            'photo' => 'nullable|image|mimes:jpg,png,svg,jpeg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('employee_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $employee->update($validatedData);

        $employee->photo = $employee->photo ? asset('storage/' . $employee->photo) : null;

        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee,
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
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted']);
    }

    
    
}

