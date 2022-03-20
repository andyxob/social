<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($username){

        $user = User::where('name', $username)->first();
        if(!$user) abort(404);

        return view('profile.index', ['user'=>$user]);
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        $this->validate($request, ['name'=>'max:20']);
        Auth::user()->update([
            'name'=>$request->input('name')
        ]);

        return redirect(route('profile.edit'));
    }
}
