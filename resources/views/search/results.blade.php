<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="get" action={{route('search.results')}}>
                        <input id="seek" class="block mt-1 "
                               type="search"
                               name="seek"
                               placeholder="Enter smthng"
                        />
                        <x-button class="ml-3 mt-3">
                            {{ __('Seek') }}
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
                    <h4>Search results using "{{Request::input('seek')}}"</h4>

                    <div class="row mt-3">
                        <div class=".col-lg-6">
                            @foreach($users as $user)
                                @include('users.partials.userblock')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
