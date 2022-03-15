@if($user->existProfiles())
<div class = "col-sm-6 mt-5">
    @if($user->profile()->maxim)
    <div class = "">
        <h5>好きな言葉</h5>
        <h4 class = "ml-4">{!!nl2br(e($user->profile()->maxim))!!}</h4>
    </div>
    @endif
    <div class = "mt-2">
        @if($user->profile()->coment)
        <h5>コメント</h5>
        <h4 class = "ml-4">{!!nl2br(e($user->profile()->coment))!!}</h4>
        @endif
    </div>
    <div class = "mt-5">
        @include('user.leftButton')
    </div>
</div>
@else
<div class = "centering col-sm-6">
    @include('user.leftButton')
</div>
@endif
