<header class="mb-4">
    @if(Auth::check())
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">タスク管理</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">{!!link_to_route('logout.get','logout',[],['class'=>'nav-link'])!!}</li>
                <li class="nav-item">{!!link_to_route('users.top','home',[],['class'=>'nav-link'])!!}</li>
            </ul>
        </div>
    </nav>
    @else
    <div class = "text-right mt-5">
        {{--{!!link_to_route('/','TOP',[],['class'=>'nav-link'])!!}--}}
        <a href="/">TOP</a>
    @endif
</header>