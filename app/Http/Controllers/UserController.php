<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('id',Auth::user()->id)->get();
        return view('Admin.User.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.User.add');  //spath sementara
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'address' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:3124',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required',
        ]);

        try {
            if($request->file('avatar')){
                $avatar = $request->file('avatar')->store('avatars','public');
            }

            User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'address' => $data['address'],
                'avatar' => $avatar,
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'],
            ]);
            return redirect()->route('user.create')->with('success','Create Account successfully');
        } catch (Exception $error) {
            return redirect()->route('user.create')->with('error',"Create Account error".$error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'address' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:3124',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);

        try {
            if($request->hasFile('avatar')){
                if($user->avatar){
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->avatar = $request->file('avatar')->store('avatars','public');
            }

            $user->username = $data['username'];
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->role = $data['role'];
            $user->save();
            return redirect()->route('user')->with('success','register successfully');
        } catch (Exception $error) {
            return redirect()->route('user')->with('error', "register failed = ".$error->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id); //mencari data berdasarkan id
        if($data->avatar){ //validasi apakah ada avatar
            if(Storage::disk('public')->exists($data->avatar)){
                Storage::disk('public')->delete($data->avatar); //menghapus avatar dari storage
            }
        }
        $data->delete(); //hapus data dari database
        return redirect()->route('user.index')->with('success','User deleted Successfully');
    }
}
