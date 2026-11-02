<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\User;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\ProfileController;

// HALAMAN UTAMA
// Pengunjung diarahkan ke dashboard.
// Jika belum login, akan diarahkan ke halaman login.
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalBuku' => Book::count(),
        'totalStok' => Book::sum('stok'),
        'totalPengguna' => User::count(),
    ]);
})->middleware(['auth'])->name('dashboard');

// ROUTE YANG HANYA BISA DIAKSES SETELAH LOGIN
Route::middleware(['auth'])->group(function () {

    // =====================================
    // PROFILE PENGGUNA
    // =====================================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // =====================================
    // DAFTAR BUKU
    // =====================================

    Route::get('/books', [BookController::class, 'index'])
        ->middleware('permission:lihat buku')
        ->name('books.index');


    // =====================================
    // TAMBAH BUKU
    // Admin dan Dosen
    // =====================================

    Route::get('/books/create', [BookController::class, 'create'])
        ->middleware('permission:tambah buku')
        ->name('books.create');

    Route::post('/books', [BookController::class, 'store'])
        ->middleware('permission:tambah buku')
        ->name('books.store');


    // =====================================
    // EDIT BUKU
    // Admin dan Dosen
    // =====================================

    Route::get('/books/{book}/edit', [BookController::class, 'edit'])
        ->middleware('permission:edit buku')
        ->name('books.edit');

    Route::put('/books/{book}', [BookController::class, 'update'])
        ->middleware('permission:edit buku')
        ->name('books.update');


    // =====================================
    // HAPUS BUKU
    // Khusus Admin
    // =====================================

    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('permission:hapus buku')
        ->name('books.destroy');


    // =====================================
    // MANAJEMEN ROLE PENGGUNA
    // Khusus Admin
    // =====================================

    Route::get('/users', [UserRoleController::class, 'index'])
        ->middleware('permission:kelola role')
        ->name('users.index');

    Route::put('/users/{user}/role', [UserRoleController::class, 'update'])
        ->middleware('permission:kelola role')
        ->name('users.update');

});

// ROUTE AUTHENTICATION BREEZE
require __DIR__.'/auth.php';
