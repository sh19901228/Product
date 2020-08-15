{{-- layouts/profile.blade.phpを読み込む--}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'プロフィールの新規作成')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <h1>Myプロフィール作成画面</h1>
@endsection