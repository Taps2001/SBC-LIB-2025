<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon for timestamps

class LoginController extends Controller
{

   

    // public function searchID(Request $request)
    // {
    //     try {
    //         $barcodeNo = $request->input('BarcodeNo');
    //         $purpose = $request->input('purpose');

    //         // Search id from tblstudenrolled
    //         $user = DB::table('tblstudenrolled as se')
    //             ->join('tblstudentinfo as si', 'se.IDno', '=', 'si.IDno') 
    //             ->select(
    //                 'se.IDno', 'se.BarcodeNo', 'se.Course',
    //                 'si.lname', 'si.fname', 'si.mi'
    //             ) 
    //             ->where('se.BarcodeNo', $barcodeNo) 
    //             ->first();

    //         if (!$user) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'ID Not Found',
    //             ], 404);
    //         }

    //         // insert the data
    //         $this->logStudentEntry($user->IDno, $user->BarcodeNo, $user->Course, $purpose);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'ID Found & Logged Successfully',
    //             'data' => [
    //                 'BarcodeNo' => $user->BarcodeNo ?? 'N/A',
    //                 'lname' => $user->lname ?? 'N/A',
    //                 'fname' => $user->fname ?? 'N/A',
    //                 'mi' => $user->mi ?? 'N/A',
    //                 'Course' => $user->Course ?? 'N/A',
    //                 'purpose' => $purpose ?? 'N/A',
    //             ],
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Server Error: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function searchID(Request $request)
    {
        try {
            $input = $request->input('BarcodeNo'); 
            $purpose = $request->input('purpose');

            // Search by matching either IDNo or BarcodeNo
            $user = DB::table('tblstudentinfo')
                ->select('IDNo', 'BarcodeNo', 'lname', 'fname', 'mi', 'vCourse')
                ->where('IDNo', $input)
                ->orWhere('BarcodeNo', $input)
                ->first();

            // insert the data
            $this->logStudentEntry($user->IDNo, $user->BarcodeNo, $user->vCourse, $purpose);
           
            return response()->json([
                'success' => true,
                'message' => $user ? 'Student found and logged.' : 'Student not found.',
                'data' => [
                    'IDNo'      => $user->IDNo ?? 'N/A',
                    'BarcodeNo' => $user->BarcodeNo ?? 'N/A',
                    'lname'     => $user->lname ?? 'N/A',
                    'fname'     => $user->fname ?? 'N/A',
                    'mi'        => $user->mi ?? 'N/A',
                    'vCourse'   => $user->vCourse ?? 'N/A',
                    'purpose'   => $purpose ?? 'N/A',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    //into tbl_login012013
    private function logStudentEntry($IDNo, $BarcodeNo, $vCourse, $purpose)
    {
        try {
            DB::table('loghistory')->insert([
                'logtime' => Carbon::now(), 
                'IDNo' => $IDNo,
                'BarcodeNo' => $BarcodeNo,
                'vCourse'=> $vCourse,
                'purpose'=> $purpose,
               
            ]);
        } catch (\Exception $e) {
           // \Log::error('Error inserting login record: ' . $e->getMessage());
        }
    }
}
