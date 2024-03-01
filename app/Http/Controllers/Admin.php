<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index(){
        if(Auth::user()->level == 'admin'){
            return view('akun.index', ['akunn' => User::all(),
            'title' =>'Akun']);
        } else {
            return view('akun.index', [
                'akunn' => User::where('id', Auth::user()->id)->get(),
                'title' => 'Akun'
            ]);
        }
    }
}