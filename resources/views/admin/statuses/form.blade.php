<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit status ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('statuses.index')}}">Go to posts</a>
                    <a href="">Go to users</a>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($status))
                        Edit {{$status->user->name}}`s status
                        <form method="post" action="{{ route ('statuses.update', $status) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                            <textarea name="body" id="body"
                                      class="form-control {{$errors->has('body') ? 'is-invalid': ''}}"
                                      placeholder="Enter something" rows="10">{{$status->body}}</textarea>
                                @if($errors->has('body'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('body')}}
                                    </div>
                                @endif
                                <input type="hidden" name="id" id="id" value="{{$status->id}}">
                                <input type="hidden" name="user" id="user" value="{{$status->user->id}}">
                                <input type="hidden" name="parent" id="parent" value="{{$status->parent_id}}">
                            </div>
                            <button type="submit"
                                    class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                                Confirm
                            </button>
                        </form>
                    @else
                        Something went wrong
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
