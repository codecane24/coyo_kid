<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {

        return view('login');
    }


    public function customLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ]
        );

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Check role
            if ($user->hasRole('Superadmin')) {
                return redirect()->route('superadmin.dashboard')->withSuccess('Signed in as Superadmin');
            }

            if($user->hasRole('Admin')) {
                Session::put('branch_id', $user->branch_id);
                $branch = Branch::find($user->branch_id);
                Session::put('branch_name', $branch->branch_name);
                Auth::user()->branch_name = $branch->branch_name;
                Auth::user()->branch_id = $branch->id;
                return redirect()->route('admin.dashboard')->withSuccess('Signed in as Admin');
            }
            // You can add more role redirects here later like:
            // elseif ($user->hasRole('Admin')) { ... }

            // Default fallback
            return redirect()->route('home')->withSuccess('Signed in');
        }

        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function registration()
    {
        return view('register');
    }


    public function customRegistration(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5|max:30',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'confirmpassword' => 'required|min:6',

            ],
            [
                'name.required' => 'Userame is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
                'confirmpassword.required' => 'confirmpassword is required',

            ]
        );

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('index');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
