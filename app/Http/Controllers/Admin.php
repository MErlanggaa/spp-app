<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index(){
        return view('akun.index', ['akun' => User::all(),
        'title' =>'Akun']);
    }
}