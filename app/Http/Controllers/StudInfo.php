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
            ->rawColumns([]) 
            ->make(true);
        }

        return response()->json(['error' => 'Unauthorized request'], 403);

       
    }

   

    public function deleteStudent($IDno)
    {
        // Cast Studno to integer
        $IDno = (int) $IDno;
    
        // Check if student exists
        $student = DB::table('tblstudentinfo')
                     ->where('IDno', $IDno)
                     ->first();
    
        if (!$student) {
            \Log::error("Student with Studno {$IDno} not found.");
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        try {
            DB::table('tblstudentinfo')
              ->where('IDno', $IDno)
              ->delete();
    
            return response()->json(['success' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            \Log::error("Error deleting student: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    
    // Fetch student details by IDno (fix: use correct model)
    public function show($id)
    {
        $student = StudentInfoModel::findOrFail($id); // Correct model: StudentInfoModel
        return response()->json($student); // Return student data as JSON
    }
    
    public function updateStudent(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'IDno' => 'required|exists:student_info,IDno',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'Gender' => 'required|string',
            // Add validation for other fields as necessary
        ]);
    
        $student = StudentInfoModel::where('IDno', $validatedData['IDno'])->first();
    
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    
        // Update student data
        $student->update([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'Gender' => $validatedData['Gender'],
            // Update other fields here
        ]);
    
        return response()->json(['success' => true, 'message' => 'Student updated successfully']);
    }
    
}
