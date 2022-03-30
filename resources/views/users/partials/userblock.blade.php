<div class="media">
    <img src=""  class="mr-3" alt="{{$user->getName()}}">
    <div class="media-body">
        <a href="{{route('profile.index', ['username'=>$user->name])}}">{{$user->getName()}}</a>
        <p>
            @if($user->sex === 'm') Male
            @else Female
            @endif
        </p>
    </div>
</div>
