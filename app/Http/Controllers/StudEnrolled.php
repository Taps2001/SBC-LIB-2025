<?php

namespace App\Http\Controllers;

use App\Models\StudEnrolledModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class StudEnrolled extends Controller
{
    public function getStudentReport(Request $request)
    {
        if ($request->ajax()) {
            $students = DB::table('tblstudenrolled as e')
                ->join('tblstudentinfo as s', 'e.IDno', '=', 's.IDNo')
                ->select([
                    'e.BarcodeNo',
                    'e.IDno',
                    DB::raw("CONCAT(s.Lname, ' ', s.Fname, ' ', s.mi) as FullName"),
                    'e.Course',
                    's.yearLevel'
                ]);

                return DataTables::of($students)
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
        $student = DB::table('tblstudenrolled')
                     ->where('IDno', $IDno)
                     ->first();
    
        if (!$student) {
            \Log::error("Student with Studno {$IDno} not found.");
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        try {
            DB::table('tblstudenrolled')
              ->where('IDno', $IDno)
              ->delete();
    
            return response()->json(['success' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            \Log::error("Error deleting student: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    



}
