<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandController;

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

// routes/web.php

Route::get('/commands/show', [CommandController::class, 'show'])->name('commands.show');
Route::get('/commands/ApiAndEmail', [CommandController::class, 'shootApiAndEmail'])->name('ApiAndEmail');
Route::get('/commands/create', [CommandController::class, 'create'])->name('commands.create');
Route::post('/commands', [CommandController::class, 'store'])->name('commands.store');
Route::delete('/commands/delete/{id}', [CommandController::class, 'delete'])->name('commands.delete');

Route::get('/', function () {
    return view('index');
});
