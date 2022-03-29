<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{route('status.post')}}">
                        @csrf
                        <div class="form-group">
                            <textarea name="status" class="form-control {{$errors->has('status') ? 'is-invalid': ''}}"
                                      placeholder="What do you want to tell about?" rows="3"></textarea>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('status')}}
                                </div>

                            @endif
                        </div>
                        <x-button type="submit">
                            Confirm
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!$statuses->count())
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <h4>There is no records on the wall</h4>
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
                                                        @endif
                                                        <li class="list-inline-item">
                                                            {{$status->likes()->count()}}
                                                            {{Str::plural('like',$status->likes()->count())}}
                                                        </li>
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
                                                                                <h2><a href="{{route('profile.index', $reply->user->name)}}">{{$reply->user->getName()}}</a></h2>

                                                                                <p>{{$reply->body}}</p>
                                                                                <ul class="list-inline">
                                                                                    <li class="list-inline-item">{{$reply->created_at->diffForHumans()  }}</li>
                                                                                    @if( $reply->user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                                                                        <li class="list-inline-item">
                                                                                            <a href="{{route('status.like', $reply->id)}}">Like</a>
                                                                                        </li>

                                                                                    @endif

                                                                                    <li class="list-inline-item">

                                                                                        {{$reply->likes()->count()}}
                                                                                        {{Str::plural('like',$reply->likes()->count())}}
                                                                                    </li>
                                                                                </ul>

                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$statuses->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
