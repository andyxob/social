<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, ['status' => 'required|max:255']);

        Auth::user()->statuses()->create([
            'body' => $request->input('status')
        ]);

        return redirect(route('dashboard'));
    }
}
