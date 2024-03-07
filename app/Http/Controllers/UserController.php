<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function index()
    {

        $user = User::all();

        return view('dashboard.user.index', [
            'title' => 'Dashboard | Users',
            'active' => 'users',
            'users' => $user,
        ]);
    }

    public function show()
    {
        return view('dashboard.user.create', [
            'title' => 'Tambah Pegawai',
        ]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:25', 'unique:users'], //harus beda
            'role' => 'required',
            'password' => 'required|min:5|max:25'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        return redirect('dashboard/data-user')->with('success', 'Berhasil Ditambahkan!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', [
            'title' => 'Data User | Edit User',
            'user' => $user,

        ]);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $instansi = User::findOrFail($id);
        $instansi->name = $validatedData['name'];
        $instansi->username = $validatedData['username'];
        $instansi->password = $validatedData['password'];
        $instansi->role = $validatedData['role'];
        $instansi->save();

        return redirect('/dashboard/data-user')->with('success', 'User updated successfully.');
    }



    // App\Http\Controllers\UserController.php
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect('dashboard/data-user')->with('success', 'User deleted successfully.');
    }
}
