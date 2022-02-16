@if($user->existProfiles())
<div class = "col-sm-6">
<div class = "">
    <h5>好きな言葉</h5>
    <h4 class = "ml-4">{{$user->profile()->maxim}}</h4>
</div>
<div class = "">
    <h5>コメント</h5>
    <h4 class = "ml-4">{{$user->profile()->coment}}</h4>
</div>
<div class = "">
    @include('user.leftButton')
</div>
</div>
@else
<div class = "centering col-sm-6">
    @include('user.leftButton')
</div>
@endif
