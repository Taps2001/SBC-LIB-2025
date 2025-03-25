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


    public function deleteStudentReport($id)
    {
        $student = StudEnrolledModel::find($id);
        if ($student) {
            $student->delete();
            return response()->json(['success' => 'Student deleted successfully.']);
        }
        return response()->json(['error' => 'Student not found.'], 404);
    }
}
