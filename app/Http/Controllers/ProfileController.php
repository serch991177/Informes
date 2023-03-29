<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;    
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    public function index()
    {
        $user = User::all();
        //dd($user);
        return view('pages.laravel-examples.user-management')->with('user',$user);
    }
    public function create()
    {
                return view('pages.profile');
    }

    public function update()
    {
            
        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
           // 'phone' => 'required|max:10',
            //'about' => 'required:max:150',
            //'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        //dd($user);
        return back()->withStatus('Perfil Actualizado Correctamente');
    
}
}
