<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    // Menampilkan daftar pengguna dan role
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    // Mengubah role pengguna
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
