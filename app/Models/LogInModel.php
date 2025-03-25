<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentInfo;


class LogInModel extends Model
{
    use HasFactory;

    protected $table = 'tblstudenrolled'; // Fix table name

    protected $primaryKey = 'IDno'; // Set primary key

    public $timestamps = false;

    protected $keyType = 'string'; // Ensure Studno is treated as a string
    public $incrementing = false; // Disable auto-increment

    protected $fillable = [
        'Studno', 'BarcodeNo', 'SYSemCode', 'IDno', 'Course',
       
    ];
    public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class, 'IDNo', 'IDNo');
    }
}

