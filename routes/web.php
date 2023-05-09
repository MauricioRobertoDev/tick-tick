<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\DepartmentCreate;
use App\Http\Livewire\DepartmentEdit;
use App\Http\Livewire\DepartmentIndex;
use App\Http\Livewire\TagList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

    Route::get('/tags', TagList::class)->name('tag.index');
    Route::get('/departamentos', DepartmentIndex::class)->name('department.index');
    Route::get('/departamentos/novo', DepartmentCreate::class)->name('department.create');
    Route::get('/departamentos/editar/{id}', DepartmentEdit::class)->name('department.edit');
});

require __DIR__.'/auth.php';
