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
</x-app-layout>
