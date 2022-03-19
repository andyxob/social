<div class="media">
    <img src=""  class="mr-3" alt="">
    <div class="media-body">
        <a href="{{route('profile.index', ['username'=>$user->name])}}">{{$user->getName()}}</a>
    </div>
</div>
