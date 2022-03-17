<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request){
        $query = $request->input('seek');

        if(!$query){
            redirect(route('search.results'));
        }

        $users = User::where('name', $query)->get();

        return view('search.results', ['users'=>$users]);
    }
}
