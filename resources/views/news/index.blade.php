<!--layouts/front.blade.phpを読み込む-->
@extends('layouts.front')

{{-- front.blade.phpの@yield('title')に'ニュース一覧'を埋め込む --}}
@section('title', 'ニュース一覧')

<!--front.blade.phpの@yield('content')セクションに以下のタグを埋め込む-->
@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <!--$headkine(最新記事のみ)にデータが無ければfalse、データがあれば実行-->
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                    <!--$headlineに画像のパス(ファイル名)があれば、storage/image/ファイル名で画像を表示-->
                                    @if ($headline->image_path)
                                        <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                                    @endif
                                </div>
                                <div class="title p-2">
                                    <!--タイトルは半角で70文字以内、全角で35文字以内-->
                                    <h1>{{ str_limit($headline->title, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--本文は半角で650文字以内、全角で325文字以内-->
                            <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                <!--$postsには投稿した日時の新しい順にデータが格納-->
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    <!--投稿日時を年月日にフォーマット-->
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ str_limit($post->title, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->body, 1500) }}
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection