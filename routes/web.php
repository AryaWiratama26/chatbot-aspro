<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KnowledgeBaseController;
use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/chatbot', [ChatbotController::class, 'chat'])->name('chatbot.chat');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        
        // Knowledge Base Routes
        Route::resource('knowledge', KnowledgeBaseController::class, [
            'as' => 'admin'
        ]);
        
        // Announcements Routes
        Route::resource('announcements', AnnouncementController::class, [
            'as' => 'admin'
        ]);
    });
});