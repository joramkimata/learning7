<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function login()
    {
        return view('users.login');
    }

    public function password() {
        $password = request()->get('password');
        $user = User::findOrFail(auth()->user()->id);
        $user->password = bcrypt($password);
        $user->save();
        return response()->json(["message" => "Successfully password changed!", "error" => false]);
    }

    public function auth()
    {

        $username = request('username');
        $password = request('password');

        if (auth()->attempt(['email' => $username, 'password' => $password])) {
            // User exists and can log in
            //auth()->user()->role;
            return redirect()->intended('/dashboard');
        } else {
            // User not found and can't log in
            return redirect()->back()->with('error', 'Invalid user');
        }
    }

    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }

    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(["message" => "Successfully deleted", "error" => false]);
    }

    public function update()
    {
        $name = request('name');
        $role = request('role');
        $username = request('username');
        $userId = request('userId');

        // Homework: You validate ok!

        $check = User::where('email', $username)
            ->where('role', $role)
            ->where('id', '!=', $userId)->count();

        if ($check > 0) {
            return response()->json(["message" => "User Exists", "error" => true]);
        } else {
            // Save User
            $user = User::find($userId);
            $user->name = $name;
            $user->email = $username;
            $user->role = $role;
            $user->save();
            return response()->json(["message" => "Successfully updated", "error" => false]);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function store()
    {
        $name = request('name');
        $role = request('role');
        $ucpassword = request('ucpassword');
        $upassword = request('upassword');
        $username = request('username');

        // Homework: You validate ok!

        $check = User::where('email', $username)->where('role', $role)->count();

        if ($check > 0) {
            return response()->json(["message" => "User Exists", "error" => true]);
        } else {
            // Save User
            $user = new User;
            $user->name = $name;
            $user->email = $username;
            $user->role = $role;
            $user->password = bcrypt($upassword); // \Hash::make($upassword);
            $user->save();
            return response()->json(["message" => "Successfully added", "error" => false]);
        }

    }

}
