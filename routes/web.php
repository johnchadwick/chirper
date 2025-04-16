<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
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
Route::get('/path-test', function() {
    return "Container path: " . realpath(__DIR__.'/../') .
        "\nFile exists? " . (file_exists(__DIR__.'/../composer.json') ? 'YES' : 'NO');
});

Route::get('/buggy-page', function() {
    $users = [
        ['name' => 'John', 'age' => 30],
        ['name' => 'Jane', 'age' => 'twenty-five'], // Intentional type error
    ];

    $totalAge = 0;
    foreach ($users as $user) {
        $totalAge += $user['age']; // This will fail on the string age
    }

    return "Average age: " . ($totalAge / count($users));
});

// routes/web.php
Route::get('/debug-test', function() {
    $log = storage_path('logs/debug_test.log');
    file_put_contents($log, "1: Start\n", FILE_APPEND);

    if (function_exists('xdebug_break')) {
        file_put_contents($log, "2: Before break\n", FILE_APPEND);
        xdebug_break();
        file_put_contents($log, "3: After break\n", FILE_APPEND);
    }

    return response()->json(['status' => 'debugging!']);
});

Route::get('/info', function() {
    xdebug_break(); // Force a breakpoint
    return view('info');
});

Route::get('/', function () {
    xdebug_break(); // Force a breakpoint
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
