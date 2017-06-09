@extends('layouts.app')

@section('login')
    <div class="login-border">
        <div class="self-flex">
            <div>
                <form class="uk-form uk-width-medium-1-3" role="form" method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <fieldset>
                        <legend>登陆</legend>
                        <div class="uk-form-row">
                            <input type="text" name="email" placeholder="输入登陆邮箱" class="{{ $errors->has('email') ? 'uk-form-danger' : '' }}">
                            @if ($errors->has('email'))
                                <p class="uk-text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <input type="password" name="password"  placeholder="输入密码" class="{{ $errors->has('password') ? 'uk-form-danger' : '' }}">

                            @if ($errors->has('password'))
                                <p class="uk-text-danger self-break">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <button class="uk-button" type="submit">登陆</button>
                        </div>
                        <div class="uk-form-row">
                            <label><input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我</label>
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
    <style>
        .login-border{
            margin:100px 40% 0 40%;
            padding:60px 0;
            border:1px solid #bbbbbb;
            border-radius: 2%;
            box-shadow: 6px 3px 12px #000000;
        }
        .self-break{
            width: 10vw;
        }
        .self-flex{
            display: flex;
            width:100%;
            flex-direction: row;
            justify-content:center;
            align-items: center;
        }

    </style>
@endsection
