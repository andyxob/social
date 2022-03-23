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
                                                        <li class="list-inline-item">
                                                            <a href="">Like</a>
                                                        </li>
                                                        <li class="list-inline-item">10 likes</li>
                                                    </ul>
                                                    <form method="post" action="#" class="mb-4">
                                                        @csrf
                                                        <div class="form-group">
                                            <textarea name="status" class="form-control" placeholder="Comment"
                                                      rows="3"></textarea>
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
