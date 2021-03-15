<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:4',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return '<script>
                    alert("Registration successfully completed!! Please login to your account"); 
                    window.location.href="/login";
                </script>';
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password')))
        {
            if (Auth::user()->role == 'owner') {
                return redirect('owner');
            }
            else if (Auth::user()->role == 'admin') {
                return redirect('admin');
            }
            else {
                return redirect('subscriber');
            }
        }
        else
        {
            return '<script>
                        alert("Incorrect email or password!!"); 
                        window.location.href="/login";
                    </script>';
        }
    }
}
