@if((Auth::user())==($team->leader())|(Auth::user())==($team->deputy())|(Auth::user())==$team->project()->manager())
<div class = "offset-sm-1 col-sm-4 mt-5">
    <div class = "text-center mt-5">
        <h4>メンバーの追加</h4>
    </div>
    <div class = "mt-4">
        <form method="POST" action="{{route('teams.memberPost',['id'=>$team->id])}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class = "row">
            <div class="col-sm-8">
                <label for='userId'></label>
                <select class='form-control' name='userId'>
                    <option value=''disabled selected style='display:none;'>選択</option>
                    @foreach($users as $user)
                        @if($user->isNotMember($team->id))
                        <option value='{{$user->id}}'@if(old('userId')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                <div class="col-sm-4">
                <button type="submit" class='btn btn-primary btn-block ml-2 mt-2'>追加</button>
            </div> 
        </div>
        </form>
    </div>
</div>
@endif