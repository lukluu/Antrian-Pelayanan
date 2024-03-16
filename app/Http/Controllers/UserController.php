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

        $user = User::with('instansi')->get();

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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'max:255',
            'username' => 'max:255',
            'password' => 'min:5',
        ]);
        $dataToUpdate = [];
        // Periksa apakah input 'name' diubah dan tambahkan ke array jika iya
        if ($request->has('name')) {
            $dataToUpdate['name'] = $request->name;
        }

        // Periksa apakah input 'username' diubah dan tambahkan ke array jika iya
        if ($request->has('username')) {
            $dataToUpdate['username'] = $request->username;
        }

        // Periksa apakah input 'password' diubah dan tambahkan ke array jika iya
        if ($request->has('password')) {
            $dataToUpdate['password'] = bcrypt($request->password);
        }

        $user->update($dataToUpdate);
        return redirect('/dashboard/data-user')->with('success', 'User updated successfully.');
    }



    // App\Http\Controllers\UserController.php
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect('dashboard/data-user')->with('success', 'User deleted successfully.');
    }


    public function profileAdmin()
    {
        $user = auth()->user();
        return view('dashboard.profile.index', [
            'title' => 'Dashboard | Profile',
            'user' => $user,
        ]);
    }
    public function editProfileAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'max:255',
            'username' => 'max:255',
            'password' => 'min:5',
        ]);
        $dataToUpdate = [];
        // Periksa apakah input 'name' diubah dan tambahkan ke array jika iya
        if ($request->has('name')) {
            $dataToUpdate['name'] = $request->name;
        }
        if ($request->has('username')) {
            $dataToUpdate['username'] = $request->username;
        }
        if ($request->has('password')) {
            $dataToUpdate['password'] = bcrypt($request->password);
        } else {
            $dataToUpdate['password'] = $user->password;
        }
        $user->update($dataToUpdate);
        return back()->with('success', 'Profile updated successfully.');
    }
}
