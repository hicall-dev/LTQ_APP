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

    public function store(Request $request) {
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
}
