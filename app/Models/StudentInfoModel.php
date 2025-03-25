<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfoModel extends Model
{
    use HasFactory;

    protected $table = 'tblstudentinfo'; // Ensure this matches your actual table name
  
    protected $fillable = [
        'IDNo', 'BarcodeNo', 'lname', 'fname', 'mi', 'username', 'vCourse',
        'HomeAddress', 'PBirth', 'Gurdian', 'Guardian_Address', 'Gender',
        'yearLevel', 'Bdate', 'Remarks', 'isprinted', 'isActive', 'idstatus', 'No'
    ];

    public $timestamps = false;
}
