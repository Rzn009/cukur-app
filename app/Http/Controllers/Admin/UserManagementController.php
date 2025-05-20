<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('pages.admin.userManagment.index', compact('users', 'roles'));
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('pages.admin.userManagment.show', compact('user', 'userRoles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.admin.userManagment.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->roles[0] ?? 'customer',
        ]);

        // Assign roles via Spatie
        $user->syncRoles($request->roles);

        // Berikan permission berdasarkan role
        foreach ($request->roles as $role) {
            $roleModel = Role::findByName($role);
            $permissions = $roleModel->permissions;
            $user->syncPermissions($permissions);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('pages.admin.userManagment.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update roles
        $user->syncRoles($request->roles ?? []);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
