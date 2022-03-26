<?php

namespace App\Http\Controllers;

use App\Models\Status;
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

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, ["reply-{$statusId}" => "required|max:255"]);

        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect(route('dashboard'));
        }
        if (!Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id) {
            return redirect(route('dashboard'));
        }

        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate( Auth::user() );
        $status ->replies()->save($reply);

        return redirect()->back();
    }
}
