<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:t_users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,customer,owner',
            'no_hp'    => 'nullable|string|max:15',
            'alamat'   => 'nullable|string|max:255',
        ]);
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'no_hp'    => $request->no_hp,
            'alamat'   => $request->alamat,
        ]);
        return redirect()->route('user.index')->with('success','User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('success','User berhasil dihapus.');
    }
}
