<?php

use App\Http\Controllers\Admin\AddonsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Global\CloudStorageController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\TeachingSubjectController;
use App\Http\Controllers\Admin\ApplicationFormController;


Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    /* Start admin auth route */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('store-login', [AuthenticatedSessionController::class, 'store'])->name('store-login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forget-password', [PasswordResetLinkController::class, 'custom_forget_password'])->name('forget-password');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'custom_reset_password_page'])->name('password.reset');
    Route::post('/reset-password-store/{token}', [NewPasswordController::class, 'custom_reset_password_store'])->name('password.reset-store');
    /* End admin auth route */

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });

        Route::get('role/assign', [RolesController::class, 'assignRoleView'])->name('role.assign');
        Route::post('role/assign/{id}', [RolesController::class, 'getAdminRoles'])->name('role.assign.admin');
        Route::put('role/assign', [RolesController::class, 'assignRoleUpdate'])->name('role.assign.update');
        Route::resource('/role', RolesController::class);
        Route::resource('/role', RolesController::class);

        // Маршруты для управления направлениями и специализациями
        Route::resource('faculties', FacultyController::class);
        Route::get('faculties/{faculty}/specializations', [FacultyController::class, 'getSpecializations'])->name('faculties.specializations');
        
        Route::resource('specializations', SpecializationController::class);
        Route::get('specializations-by-faculty/{facultyId}', [SpecializationController::class, 'getByFaculty'])->name('specializations.by-faculty');
        Route::put('specializations/{specialization}/toggle-status', [SpecializationController::class, 'toggleStatus'])->name('specializations.toggle-status');
        
        // Маршруты для управления преподаваемыми предметами
        Route::resource('teaching-subjects', TeachingSubjectController::class);
        Route::put('teaching-subjects/{teachingSubject}/toggle-status', [TeachingSubjectController::class, 'toggleStatus'])->name('teaching-subjects.toggle-status');
        
        // Маршруты для управления заявками на обучение
        Route::resource('application-forms', ApplicationFormController::class);
        Route::put('application-forms/{applicationForm}/update-status', [ApplicationFormController::class, 'updateStatus'])->name('application-forms.update-status');
        Route::get('application-forms-export', [ApplicationFormController::class, 'export'])->name('application-forms.export');
        Route::get('application-forms-statistics', [ApplicationFormController::class, 'statistics'])->name('application-forms.statistics');
        
    });
    Route::resource('admin', AdminController::class)->except('show');
    Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin.status');
    // Settings routes
    Route::get('settings', [SettingController::class, 'settings'])->name('settings');
    Route::post('cloud/store', [CloudStorageController::class, 'store'])->name('cloud.store');
    Route::get('sync-modules', [AddonsController::class, 'syncModules'])->name('addons.sync');
});
