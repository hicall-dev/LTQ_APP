<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view(
            'register.index',
            ['title' => 'Register']
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            //'email' => 'nullable',
            'username' => 'required|min:5|max:255|unique:users',
            'password' => 'required|min:5|max:255'

        ]);
        //$validatedData['email'] = $validatedData['email'] ?? 'admin@mail.com';

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // $request->flash('success', 'Harap Login');
        return redirect('/login')->with('success', 'Berhasil Mendaftar, Harap Login');
        // return $request->all();

    }

    public function addAdmin()
    {
        $admin = User::where('role', '1')->get();
        return view(
            'formadmin',
            [
                'title' => 'Dashboard',
                'judul' => 'Tambah Pembimbing',
                'admins' => $admin
            ]
        );
    }

    public function createAdmin(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            //'email' => 'nullable',
            'username' => 'required|min:5|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // $request->flash('success', 'Harap Login');
        return redirect('/dashboard/santri')->with('success', 'Berhasil Mendaftarkan');
    }

    public function peek(User $user)
    {
        $admin = $user;
        // dd($admin);
        return view(
            'formadmin',
            [
                'title' => 'Dashboard',
                'judul' => 'Edit Admin',
                'admin' => $admin
            ]
        );
    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:255',
            'password' => 'nullable|max:255',
            'old_username' => 'nullable'
        ]);

        $user = User::where('username', $validatedData['old_username'])->first();

        // Update username hanya jika berbeda
        if ($validatedData['username'] !== $validatedData['old_username']) {
            $user->username = $validatedData['username'];
        }

        // Update name
        $user->name = $validatedData['name'];


        // Update password hanya jika diisi
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect('/dashboard/santri')->with('success', 'Data Admin berhasil diperbarui.');
    }


    public function destroy(User $user)
    {
        // dd(($user->id));
        User::destroy($user->id);
        return redirect('/dashboard/santri')->with('success', 'Berhasil Menghapus');
    }
}
