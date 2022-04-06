<div class="media">
    <img src="{{\Illuminate\Support\Facades\Storage::url($user->image)}}"  class="mr-3" >
    <div class="media-body">
        <a href="{{route('profile.index', ['username'=>$user->name])}}">{{$user->getName()}}</a>
        <p>
            @if($user->sex === 'm') Male
            @else Female
            @endif
        </p>
    </div>
</div>
