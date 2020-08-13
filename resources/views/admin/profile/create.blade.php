<!--{{-- layouts/profile.blade.phpを読み込む-- }}-->
@extends('layouts.profile')
<!--{{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}-->
@section('title', 'ニュースの新規作成')

<!--{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}-->
@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyNews</title>
</head>
<body>
    <h1>Myプロフィール作成画面</h1>
</body>
</html>
@endsection