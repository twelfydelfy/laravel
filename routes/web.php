<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\FisierController;

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
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::resource('studenti', StudentController::class)->parameters([
    'studenti' => 'student'
]);






Route::get('/fisiere', [FisierController::class, 'index'])->name('fisiere.index');
Route::get('/fisiere/{fisier}/download', [FisierController::class, 'download'])->name('fisiere.download');

Route::middleware(['auth'])->group(function () {
    Route::post('/fisiere', [FisierController::class, 'store'])->name('fisiere.store');
    Route::delete('/fisiere/{fisier}', [FisierController::class, 'destroy'])->name('fisiere.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('polls', PollController::class)->except(['show']);
    Route::post('/polls/{poll}/vote', [PollController::class, 'vote'])->name('polls.vote');
    Route::delete('/polls/{poll}/unvote', [PollController::class, 'unvote'])->name('polls.unvote');
});

require __DIR__.'/auth.php';