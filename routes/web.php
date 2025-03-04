<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Exports\TaskExport;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginPost'])->name('login');
});

// ใช้ middleware auth กับ route ที่ต้องการ
Route::middleware(['auth', 'banned'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/admin-dashboard', [UserController::class, 'index'])->name('admin-dashboard');

    Route::get('/add-task', function () {
        return view('project.add');
    })->name('add-task');

    Route::get('/project', function () {
        return view('projects');
    })->name('projects');

    Route::get('/account-setting', function () {
        return view('account_setting');
    })->name('account_setting');

    Route::get('/summary-schedule', function () {
        return view('summary-schedule');
    })->name('summary-schedule');

    Route::get('/personal', function () {
        return view('personal');
        // dd($data);
    })->name('personal');

    Route::get('/add-personal', function () {
        return view('project.addpersonnel');
    })->name('addpersonal');

    Route::get('/system-setting', function () {
        return view('system-setting');
    })->name('system-setting');

    Route::get('/profile-view/{id}', function ($id) { //ดูข้อมูลโปรไฟล์
        return view('project.view', compact('id'));
    })->name('profile-view');

    Route::get('/profile-edit/{id}', function ($id) { //แก้ไขข้อมูลโปรไฟล์
        return view('project.edit', compact('id'));
    })->name('profile-edit');

    Route::get('/task-edit/{id}', function ($id) {
        return view('project.edittask', compact('id'));
    })->name('task-edit');

    Route::get('/restore', function () {
        return view('restore');
    })->name('restore');

    Route::get('/restore-task', function () {
        return view('restore-task');
    })->name('restore-task');

    Route::get('/type-management', function () {
        return view('type-management');
    })->name('type-management');

    Route::get('/export-tasks', function (Request $request) {
        $selectedUser = $request->input('selectedUser');
        $statusFilter = $request->input('statusFilter');
        $typeFilter = $request->input('typeFilter');

        $export = new TaskExport($selectedUser, $statusFilter, $typeFilter);
        return $export->export();
    })->name('export-tasks');

    Route::get('send-email-tasks', [MailController::class, 'sendEmailTasks'])->name('send-email-tasks');
});

Route::get('/home', [UserController::class, 'index']);
