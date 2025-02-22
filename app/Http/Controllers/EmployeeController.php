<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
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
}

