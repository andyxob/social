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

        $statuses = $user->statuses()->notReply()->get();

        return view('profile.index', ['user'=>$user,
            'statuses'=>$statuses,
            'authUserIsFriend'=>Auth::user()->isFriendWith($user)]);
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        $this->validate($request, ['name'=>'max:20',
//            'image'=>'img,jpeg'
        ]);
        Auth::user()->update([
            'name'=>$request->input('name'),
            /*'image'=>$request->input('image'),*/
        ]);

        return redirect(route('profile.edit'));
    }
}
