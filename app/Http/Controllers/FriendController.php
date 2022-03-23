<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index', ['friends' => $friends,
            'user' => Auth::user(),
            'requests' => $requests]);
    }

    public function getAdd($name)
    {

        $user = User::where('name', $name)->first();

        //If not user
        if (!$user) {
            return redirect(route('dashboard'));
        }




        //if sent a friend request
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect(route('profile.index',  $user->name));
        }

        //if users are friends already
        if (Auth::user()->isFriendWith($user)) {
            return redirect(route('profile.index', $user->name));
        }

        Auth::user()->addFriend($user);

        return redirect(route('profile.index', $name));
    }

    public function getAccept($name){
        $user = User::where('name', $name)->first();

        //If not user
        if (!$user) {
            return redirect(route('dashboard'));
        }

        if(Auth::user()->id ===$user->id){
            return redirect(route('dashboard'));
        }

        if(!Auth::user()->hasFriendRequestRcieved($user)){
            return redirect(route('dashboard'));
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect(route('friends.index', $user));

    }

    public function postDelete($name){
        $user = User::where('name', $name)->first();

        //If not user
        if (!$user) {
            return redirect(route('dashboard'));
        }

        if(! Auth::user()->isFriendWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);
        return redirect()->back();
    }
}
