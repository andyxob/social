<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}`s friends
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Friends</h2>

                    @if(!$friends->count())
                        <h4>{{$user->name}} has no friends</h4>
                    @else
                        @foreach($friends as $user)
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
                <h2>
                    Requests to be friends

                    @if(!$requests->count())
                        <h4>{{$user->name}} has no requests</h4>
                    @else
                        @foreach($requests as $user)
                            @include('users.partials.userblock')
                        @endforeach
                    @endif

                </h2>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
