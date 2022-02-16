@extends('commons.layouts')
@section('content')
@include('commons.navbar')
<div class = ''>
    <h3 class = "centering">ログイン</h3>
    <div class = 'mt-4 offset-sm-3 col-sm-6'>
        <form method = "post" action = "{{route('login')}}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id = 'email' type = "email" class="form-control @error('email') is-envalid @enderror" name="email" value="{{old('email)')}}" required autocomplete ="email" autofocus>
                @error("email")
                    <span class ="invlid-feedback" role = "alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error("email")
                    <span class="invlid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{('パスワードを保存')}}</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="offset-sm-3 col-sm-6">
                    <button type="submit" class="btn btn-outline-primary btn-block">
                        {{('ログイン')}}
                    </button>
                </div>
            </div>
            <div class="text-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">パスワードを忘れた</a>
                @endif
            </div>
        </form>
    </div>
</div> 
@endsection('content')