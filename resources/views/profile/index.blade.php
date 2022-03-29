<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}`s profile
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('profile.edit')}}">Edit profile</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(Auth::user()->hasFriendRequestPending($user))

                        <p>Waiting for accepting friend request from {{$user->getName()}} </p>

                    @elseif(Auth::user()->hasFriendRequestRcieved($user))
                        <div class="flex items-center justify-end mt-4">
                                <a href="{{route('friends.accept', $user->name)}}">Confirm</a>
                        </div>

                    @elseif(Auth::user()->isFriendWith($user))
                        {{$user->getName()}} is your friend
                        <form method="post" action="{{route('friends.delete', ['name'=>$user->name])}}" >
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete friend">
                        </form>

                    @elseif(Auth::user()->id !== $user->id)
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn btn-success" href="{{route('friends.add', ['name'=>$user->name])}}">Add friend</a>
                        </div>
                    @endif

                    <h4><a href="{{route('friends.index')}}">{{$user->getName()}}`s friends</a></h4>

                    @if(!$user->friends()->count())
                        <p>{{$user->getName()}} has no friends at the moment</p>
                    @else
                        @foreach($user->friends() as $user)
                            @include('users.partials.userblock')
                        @endforeach

                    @endif

                </div>
            </div>
        </div>

    </div>


    @if(!$statuses->count())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h4>{{$user->getName()}} has no records at the moment</h4>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($statuses as $status)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="media">
                                <a class="mr-3" href="{{route('profile.index', $status->user->name)}}">
                                    <img class="media-object-rounded" src=""
                                         alt="{{$status->user->getName()}}">
                                </a>
                                <div class="media-body">
                                    <h2>
                                        <a href="{{route('profile.index', $status->user->name)}}">{{$status->user->getName()}}</a>
                                    </h2>
                                    <p>{{$status->body}}</p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">{{$status->created_at->diffForHumans()  }}</li>
                                        @if( $status->user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                            <li class="list-inline-item">
                                                <a href="{{route('status.like', $status->id)}}">Like</a>
                                            </li>
                                            <li class="list-inline-item">10 likes</li>
                                        @endif
                                    </ul>
                                    @foreach($status->replies as $reply)
                                        <div class="py-12">
                                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                    <div class="p-6 bg-white border-b border-gray-200">
                                                        <div class="media">
                                                            <a class="mr-3" href="{{route('profile.index', $reply->user->name)}}">
                                                                <img class="media-object-rounded" src=""
                                                                     alt="{{$reply->user->getName()}}">
                                                            </a>
                                                            <div class="media-body">
                                                                <h2>
                                                                    <a href="{{route('profile.index', $reply->user->name)}}">{{$reply->user->getName()}}</a>
                                                                </h2>
                                                                <p>{{$reply->body}}</p>
                                                                <ul class="list-inline">
                                                                    @if( $reply->user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                                                        <li class="list-inline-item">
                                                                            <a href="{{route('status.like', $reply->id)}}">Like</a>
                                                                        </li>
                                                                        <li class="list-inline-item">10 likes</li>
                                                                    @endif
                                                                </ul>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($authUserIsFriend || Auth::user()->id === $status->user->id)
                                    <form method="post" action="{{route('status.reply', $status->id)}}" class="mb-4">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="reply-{{$status->id}}" class="form-control {{$errors->has("reply-{$status->id}") ? 'is-invalid':''}}" placeholder="Comment"
                                                      rows="3"></textarea>
                                            @if($errors->has("reply-{$status->id}"))
                                                <div class="invalid-feedback">
                                                    {{$errors->first("reply-{$status->id}")}}
                                                </div>

                                            @endif
                                        </div>
                                        <x-button>
                                            Comment
                                        </x-button>

                                    </form>

                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--{{$statuses->links()}}--}}
    @endif

</x-app-layout>
