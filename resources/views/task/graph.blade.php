<div class = 'mt-5'>    
    <div class = 'row'>
        <div class = 'highLow col-4'>
            @foreach($highlowTasks as $task)
                @include('task.index')
            @endforeach
            {{$highlowTasks->links()}}
        </div>
        <div class = 'highMid col-4'>
            @foreach($highmidTasks as $task)
                @include('task.index')
            @endforeach
            {{$highmidTasks->links()}}
        </div>
        <div class = 'highHigh col-4'>
            @foreach($highhighTasks as $task)
                @include('task.index')
            @endforeach
            {{$highhighTasks->links()}}
        </div>
    </div>
    <div class = 'row'>
        <div class = 'midLow col-4'>
            @foreach($midlowTasks as $task)
                @include('task.index')
            @endforeach
            {{$midlowTasks->links()}}
        </div>
        <div class = 'midMid col-4'>
            @foreach($midmidTasks as $task)
                @include('task.index')
            @endforeach
            {{$midmidTasks->links()}}
        </div>
        <div class = 'midHigh col-4'>
            @foreach($midhighTasks as $task)
                @include('task.index')
            @endforeach
            {{$midhighTasks->links()}}
        </div>
    </div>
    <div class = 'row'>
        <div class = 'lowLow col-4'>
            @foreach($lowlowTasks as $task)
                @include('task.index')
            @endforeach
            {{$lowlowTasks->links()}}
        </div>
        <div class = 'lowMid col-4'>
            @foreach($lowmidTasks as $task)
                @include('task.index')
            @endforeach
            {{$lowmidTasks->links()}}
        </div>
        <div class = 'lowHigh col-4'>
            @foreach($lowhighTasks as $task)
                @include('task.index')
            @endforeach
            {{$lowhighTasks->links()}}
        </div>
    </div>
</div>