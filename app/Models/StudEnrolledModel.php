<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudEnrolledModel extends Model
{
    protected $table = 'tblstudenrolled';
    public $timestamps = false;
    protected $fillable = ['Studno', 'SYSemCode', 'BarcodeNo', 'IDno', 'Course'];
}
