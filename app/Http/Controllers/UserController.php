<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userShowAll()
    {
        $users = User::all();
        return view('users.index', [
            "title" => "Users",
            "users" => $users,
        ]);
    }
    public function addDataUser(Request $request)
    {
        // dd($request->password);
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Format nama tidak valid.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'role.required' => 'Role harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.string' => 'Format email tidak valid.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'password harus diisi.',
            'password.string' => 'Format password tidak valid.',
            'password.min' => 'password minimal 8 karakter.',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->password = Hash::make($request->password);

        $user->save();
        return back()->with('success', 'Registrasi Akun Berhasil');
    }
    public function editDataUser(Request $request, $id)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Format nama tidak valid.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'role.required' => 'Role harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.string' => 'Format email tidak valid.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'password.required' => 'password harus diisi kawan kawan.',
            'password.string' => 'Format password tidak valid.',
            'password.min' => 'password minimal 8 karakter.',
        ]);

        $user = user::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->password = Hash::make($request->password);

        $user->save();

        // Additional logic or redirection after successful data update
        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }
    public function deleteDataUser(Request $request, $id)
    {
        $user = auth()->user();

        $user = user::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $user->updated_at = date('Y-m-d H:i:s');
        $user->status = 0;
        $user->save();

        // Additional logic or redirection after successful data update
        return redirect()->back()->with('success', 'Data berhasil Dihapus!');
    }
}
