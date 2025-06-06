<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\LogInModel;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudEnrolled;
use App\Http\Controllers\StudInfo;



Route::get('/', function () {
    return view('Home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home or login page
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Pages
Route::get('/study', function () { return view('study'); });
Route::get('/borrow_book', function () { return view('borrow_book'); });
Route::get('/photocopy', function () { return view('photocopy'); });
Route::get('/research', function () { return view('research'); });
Route::get('/about', function () { return view('about'); });


// AJAX Search Route
Route::get('/search-id', [LoginController::class, 'searchID'])->name('search.id');

// Last Login Route
Route::get('/last-login', function (Request $request) {
    $BarcodeNo = $request->query('BarcodeNo'); 
    $user = LogInModel::where('BarcodeNo', $BarcodeNo)->first();

    return view('last-login', compact('user'));
})->name('last-login');


Route::middleware(['auth', 'web'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    // Sidebar Pages (Using Controllers for better organization)
    Route::view('/student_info', 'Sidebar.student_info')->name('student_info');
    Route::view('/student_enrolled', 'Sidebar.student_enrolled')->name('student_enrolled');
    Route::view('/student_report', 'Sidebar.student_report')->name('student_report');
    Route::view('/users', 'Sidebar.users')->name('users');

    // Users
    Route::get('/users/list', [UserController::class, 'getUsers'])->name('users.list');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

    // Student Report Routes
    Route::get('/student_report/list', [StudEnrolled::class, 'getStudentReport'])->name('student_report.list');
    Route::delete('/student_report/delete/{IDno}', [StudEnrolled::class, 'deleteStudent']);

    // Student Info Routes
    Route::get('/student_info/list', [StudInfo::class, 'getStudentInfo'])->name('student_info.list');
    Route::post('/student_info/add', [StudInfo::class, 'AddStudent']);
    Route::get('/student_info/{IDNo}/edit', [StudInfo::class, 'edit']);
    Route::put('/student_info/{IDNo}/update', [StudInfo::class, 'update']);
    Route::delete('/student_info/delete/{IDno}', [StudInfo::class, 'deleteStudent']);
    
  
});

