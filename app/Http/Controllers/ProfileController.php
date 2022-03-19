<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile($username){

        $user = User::where('name', $username)->first();
        if(!$user) abort(404);

        return view('profile.index', ['user'=>$user]);
    }
}
