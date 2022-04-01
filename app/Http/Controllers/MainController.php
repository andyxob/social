<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class MainController extends Controller
{
    public function index(){
        if(Auth::check()){
            $statuses = Status::notReply()->where(function ($query){
                return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            })->orderBy('created_at', 'desc')->paginate(100);

            return view('dashboard', ['statuses'=>$statuses]);
        }

        return view('auth.login');
    }

    public function admin(){
        return view('admin.index');
    }
}
