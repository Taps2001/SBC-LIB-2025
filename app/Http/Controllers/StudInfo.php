<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\StudentInfoModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class StudInfo extends Controller
{
    public function getStudentInfo(Request $request)
    {
        if ($request->ajax()) {
            $studentsinfo = StudentInfoModel::select([
                'IDno',
                DB::raw("CONCAT(lname, ' ', Fname, ' ', mi) as FullName"),
                'Gender', 'vCourse', 'HomeAddress', 'isActive'
            ]);

            return DataTables::of($studentsinfo)
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn-add" onclick="createUser()">Add</button>
                        <button class="btn-edit" onclick="editUser(\'' . $row->IDno . '\')">Update</button>
                        <button class="btn-delete" onclick="deleteUser(\'' . $row->IDno . '\')">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['error' => 'Unauthorized request'], 403);

       
    }

    public function updateStudent(Request $request)
    {

        // Validate incoming request data
        $validatedData = $request->validate([
            'IDno' => 'required|exists:student_info,IDno', // Ensure the student exists
            'fname' => 'required|string',
            'lname' => 'required|string',
            'Gender' => 'required|string',
            'vCourse' => 'nullable|string',
            'yearLevel' => 'nullable|string',
            'Bdate' => 'nullable|date',
            'HomeAddress' => 'nullable|string',
            'Gurdian' => 'nullable|string',
            'Guardian_Address' => 'nullable|string',
            'Remarks' => 'nullable|string',
        ]);
    
        // Find student by ID
        $student = StudentInfoModel::where('IDno', $validatedData['IDno'])->first();
    
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    
        // Update student data
        $student->update([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'Gender' => $validatedData['Gender'],
            'vCourse' => $validatedData['vCourse'] ?? null,
            'yearLevel' => $validatedData['yearLevel'] ?? null,
            'Bdate' => $validatedData['Bdate'] ?? null,
            'HomeAddress' => $validatedData['HomeAddress'] ?? null,
            'Gurdian' => $validatedData['Gurdian'] ?? null,
            'Guardian_Address' => $validatedData['Guardian_Address'] ?? null,
            'Remarks' => $validatedData['Remarks'] ?? null,
        ]);
    
        return response()->json(['success' => true, 'message' => 'Student updated successfully']);
    }
    



    

    
}
