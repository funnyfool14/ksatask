@extends('commons.layouts')
@section('content')
@include('commons.navbar')
<div class = ''>
    <h3 class = "centering">ログイン</h3>
    <div class = 'mt-4 offset-sm-3 col-sm-6'>
        <form method = "post" action = "{{route('register')}}">
            @csrf
            <div class = "row form-group">
                <div class="">
                    <label for="firstName">姓</label>
                    <input id = 'firstName' type = "firstName" class="form-control @error('firstName') is-envalid @enderror" name="firstName" value="{{old('firstName)')}}" required autocomplete ="firstName" autofocus>
                    @error("firstName")
                        <span class ="invlid-feedback" role = "alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="ml-3">
                    <label for="lastName">名</label>
                    <input id = 'lastName' type = "lastName" class="form-control @error('lastName') is-envalid @enderror" name="lastName" value="{{old('lastName)')}}" required autocomplete ="lastName" autofocus>
                    @error("lastName")
                        <span class ="invlid-feedback" role = "alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email">メールアドレス</label>
                <input id = 'email' type = "email" class="form-control @error('email') is-envalid @enderror" name="email" value="{{old('email)')}}" required autocomplete ="email" autofocus>
                @error("email")
                    <span class ="invlid-feedback" role = "alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row">
                <label for="password">パスワード（8文字以上）</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error("email")
                    <span class="invlid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row">
            <label for="password-confirm">パスワードの確認</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="current-password">
                @error("email")
                    <span class="invlid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{('パスワードを保存')}}</label>
                </div>
            </div>
            <div class="form-group">
                <div class="offset-sm-3 col-sm-6">
                    <button type="submit" class="btn btn-outline-primary btn-block">
                        {{('登録')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> 
@endsection('content')