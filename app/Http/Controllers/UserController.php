<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Blog;

class UserController extends Controller
{
    public function registerPost(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/',
            'confirm_password' => 'required|same:password'
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number',
            'confirm_password.required' => 'Confirm password is required',
            'confirm_password.same' => 'Confirm password must match password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session()->flash('registration-success', 'You have successfully registered!');
        return redirect()->route('sign-in');
    }

    public function signInPost(Request $request)
    {
        $this->validate($request,
        [
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Session()->put('user', $user->id);
                return redirect()->route('userProfile');
            } else {
                Session()->flash('sign-in-error', 'Invalid email or password!');
                return redirect()->route('sign-in');
            }
        } else {
            Session()->flash('sign-in-error', 'Invalid email or password!');
            return redirect()->route('sign-in');
        }
    }

    public function userProfile()
    {
        $loggedUser = User::find(Session()->get('user'));
        $blogs = Blog::where('user_id', $loggedUser->id)->orderBy('created_at', 'desc')->get();
        return view('profile', compact('blogs'))->with('loggedUser', $loggedUser);
    }

    public function signOut()
    {
        Session()->forget('user');
        return redirect()->route('sign-in');
    }
}
