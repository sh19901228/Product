{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-box card">
                    <!--resources/lang/ja/messages.phpファイルからLogin文字列を取得する-->
                    <div class="login-header card-header mx-auto">{{ __('messages.Login') }}</div>

                    <div class="login-body card-body">
                         <!--loginというURLを生成する-->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <!--$errosは、エラーメッセージが格納される配列、has('email')は、emailフィールドで発生したエラーメッセージ、つまりエラーがある場合is-invalid(無効)が表示され、エラーが無ければ何も表示されない-->
                                    <!--oldヘルパ関数はセッションにフラッシュデータ（一時的にしか保存されないデータ）として入力されているデータを取得する、つまり、直前までemailフィールドでユーザーが入力していた値のこと-->
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <!--emailフィールドの1つのエラーメッセージを取得する-->
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    <!--passwordフィールドでエラーが発生した場合、passwordフィールドの1つのエラーメッセージを取得する-->
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('messages.Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection