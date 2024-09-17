<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(): View
    {
        return view('Auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register_action(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'address' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:3124',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);
        try {
            if($request->file('avatar')){
                $data = $request->file('avatar')->store('avatars','public');
            }

            User::create($data);
            return redirect()->route('login')->with('success','register successfully');
        } catch (Exception $e) {
            return redirect()->route('login')->with('success','register successfully');
        }
    }

    public function login_action(Request $request) : RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if(Auth::attempt($data)){
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                case 'librarian':
                    return redirect()->route('dashboard')->with('success','login successfully');
                case 'reader':
                    return redirect()->route('homepage')->with('success','login successfully');
                default:
                return redirect()->back()->with('error','login error (Undefined role)');
            }
        }
        return redirect()->back()->with('error','login failed');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        Auth::logout();

        return redirect()->route('login')->with('success','logout successfully');
    }
}
