<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::get('/issues/search',[IssueController::class,'search'])->name('issues.search');
    Route::resource('issues',IssueController::class);
    Route::resource('tags',TagController::class);
    Route::post('toggle',[TagController::class,'toggleTag'])->name('issues.tags.toggle');
    Route::get('issues/{issue}/comments',[CommentController::class,'index'])->name('issues.comments.index');
    Route::post('issues/{issue}/comments',[CommentController::class,'store'])->name('issues.comments.store');
});

require __DIR__.'/auth.php';
