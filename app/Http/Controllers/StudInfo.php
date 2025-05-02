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
            // Define the base query
            $studentsinfo = DB::table('tblstudentinfo')
                ->select([
                    'IDNo',
                    'lname',
                    'fname',
                    'mi',
                    'Gender',
                    'vCourse',
                    'HomeAddress',
                    'isActive'
                ]);
    
            // Apply global search if a search term is provided
            if ($search = $request->get('search')['value']) {
                $studentsinfo->where(function($query) use ($search) {
                    $query->where('lname', 'like', "%{$search}%")
                          ->orWhere('fname', 'like', "%{$search}%")
                          ->orWhere('mi', 'like', "%{$search}%");
                });
            }
    
            // Return the DataTables response
            return DataTables::of($studentsinfo)
                ->addColumn('FullName', function($row) {
                    return "{$row->lname} {$row->fname} {$row->mi}";
                })
                ->make(true);
        }
    
        return response()->json(['error' => 'Unauthorized request'], 403);
    }

    public function AddStudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'IDNo' => 'required|unique:tblstudentinfo,IDNo', 
                'BarcodeNo' => 'nullable|string|max:40',
                'lname' => 'nullable|string|max:35',
                'fname' => 'nullable|string|max:25',
                'mi' => 'nullable|string|max:25',
                'Gender' => 'nullable|string|max:15',
                // 'isActive' => 'nullable|boolean',
                'vCourse' => 'nullable|string|max:45',
                'yearLevel' => 'nullable|string|max:15',
                'Bdate' => 'nullable|date',
                'PBirth' => 'nullable|string|max:45',
                'HomeAddress' => 'nullable|string|max:45',
                'Gurdian' => 'nullable|string|max:45',
                'Guardian_Address' => 'nullable|string|max:45',
                'idstatus' => 'nullable|string|max:45',
                'Remarks' => 'nullable|string|max:45',
                'isenrolled' => 'nullable|string|max:45',
            ]);

            $student = DB::table('tblstudentinfo')
                    ->where('IDNo', $validated['IDNo'])
                    ->orwhere('BarcodeNo', $validated['BarcodeNo'])
                    ->first();

            if ($student) {
                return response()->json(['message' => 'Student data already exists.'], 400);  
            } else {
                DB::table('tblstudentinfo')->insert([
                    'IDNo' => $validated['IDNo'],
                    'BarcodeNo' => $validated['BarcodeNo'],
                    'lname' => $validated['lname'],
                    'fname' => $validated['fname'],
                    'mi' => $validated['mi'],
                    'Gender' => $validated['Gender'],
                    // 'isActive' => $validated['isActive'],
                    'vCourse' => $validated['vCourse'],
                    'yearLevel' => $validated['yearLevel'],
                    'Bdate' => $validated['Bdate'],
                    'PBirth' => $validated['PBirth'],
                    'HomeAddress' => $validated['HomeAddress'],
                    'Gurdian' => $validated['Gurdian'],
                    'Guardian_Address' => $validated['Guardian_Address'],
                    'idstatus' => $validated['idstatus'],
                    'Remarks' => $validated['Remarks'],
                    'isenrolled' => $validated['isenrolled'],
                ]);

                return response()->json(['message' => 'Student added successfully.'], 201); 
            }
        } catch (\Exception $e) {
            // Return the exception message in the response to the client
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(), 
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    
    public function deleteStudent($IDNo)
    {
        // Cast Studno to integer
        $IDNo = (int) $IDNo;
    
        $student = DB::table('tblstudentinfo')
                     ->where('IDNo', $IDNo)
                     ->first();
    
        if (!$student) {
            \Log::error("Student with Studno {$IDNo} not found.");
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        try {
            DB::table('tblstudentinfo')
              ->where('IDNo', $IDNo)
              ->delete();
    
            return response()->json(['success' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            \Log::error("Error deleting student: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function edit($IDNo)
    {
        $tblstudentinfo = DB::table('tblstudentinfo')->where('IDNo', $IDNo)->first(); // Retrieve the participant by ID
        if ($tblstudentinfo) {
            return response()->json($tblstudentinfo); // Return participant data as JSON
        } else {
            return response()->json(['message' => 'Data ID not found'], 404);
        }
    }
    
    public function update(Request $request, $IDNo)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'IDNo' => 'required|string',
            'BarcodeNo' => 'nullable|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mi' => 'nullable|string',
            'Gender' => 'required|string',
            // 'isActive' => 'nullable|numeric',
            'vCourse' => 'nullable|string',
            'yearLevel' => 'nullable|string',
            'Bdate' => 'nullable|date',
            'PBirth' => 'nullable|string',
            'HomeAddress' => 'nullable|string',
            'Gurdian' => 'nullable|string',
            'Guardian_Address' => 'nullable|string',
            'idstatus' => 'nullable|string',
            'Remarks' => 'nullable|string',
            'isenrolled' => 'nullable|string',
        ]);
    
        // Check if the student exists
        $student = DB::table('tblstudentinfo')->where('IDNo', $IDNo)->first();
    
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
    
        // Update the student record
        DB::table('tblstudentinfo')->where('IDNo', $IDNo)->update([
            'BarcodeNo' => $request->input('BarcodeNo'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'mi' => $request->input('mi'),
            'Gender' => $request->input('Gender'),
            'isActive' => $request->input('isActive'),
            'vCourse' => $request->input('vCourse'),
            'yearLevel' => $request->input('yearLevel'),
            'Bdate' => $request->input('Bdate'),
            'PBirth' => $request->input('PBirth'),
            'HomeAddress' => $request->input('HomeAddress'),
            'Gurdian' => $request->input('Gurdian'),
            'Guardian_Address' => $request->input('Guardian_Address'),
            'idstatus' => $request->input('idstatus'),
            'Remarks' => $request->input('Remarks'),
            'isenrolled' => $request->input('isenrolled'),
        ]);
    
        return response()->json(['success' => true, 'message' => 'Student updated successfully']);
    }
    
    
}
