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


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                в.юповадлповдаопдл\
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
