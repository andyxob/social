<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
    @if(isset($user))
        <h1>Edit user {{$user->name}}</h1>
    @else
            <h1>Create user</h1>
    @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST"
              @if(isset($user))
              action="{{ route('users.update', $user) }}">
        @else
            action ="{{route('users.store')}}">
        @endif
        @csrf

            @if(isset($user))
                @method('PUT')
            @endif

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <input id="name" class="block mt-1 w-full" type="text" name="name" @if(isset($user)) value="{{$user->name}}" @endif required autofocus >
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <input id="email" class="block mt-1 w-full" type="email" name="email" @if(isset($user)) value="{{$user->email}}" @endif required />
            </div>

            <!-- Password -->
            @if( ! isset($user))
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password" />
            </div>
            @endif

            <!-- Confirm Password -->
            {{--<div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required />
            </div>--}}



            <div class="mt-4">
                <x-label for="sex" :value="__('Choose gender')" />

                <select class="block mt-1 w-full"
                        name="sex" required >
                    <option value="m" {{old('sex') === 'm' ? 'selected' : ''}}>Male</option>
                    <option value="f" {{old('sex') === 'f' ? 'selected' : ''}}>Female</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                {{--<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>--}}

                @if(isset($user))
                <x-button class="ml-4" type="submit">

                    {{ __('Edit') }}

                </x-button>
                @else

                    <x-button type="submit" class="ml-4">

                        {{ __('Create') }}

                    </x-button>
                    @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
