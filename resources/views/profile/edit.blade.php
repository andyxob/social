<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('profile.edit') }}">
                    @csrf
                        <div>
                            <x-label for="name" :value="__('Username')" />

                            <x-input value="{{Auth::user()->name}}" id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus />
                        </div>

                       {{-- <div class="mt-3">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
--}}
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Edit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
