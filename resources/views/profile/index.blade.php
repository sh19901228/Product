@extends('layouts.pfront')

{{-- pfront.blade.phpの@yield('title')に'記事一覧'を埋め込む --}}
@section('title', '記事一覧')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="date">{{ str_limit($headline->updated_at->format('Y年m月d日'), 20) }}</h1>
                        </div>
                            <div class="text col-md-6">
                                <div class="col-md-6">
                                  <p class="name mx-auto">{{ str_limit($headline->name, 20) }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="gender mx-auto">{{ str_limit($headline->gender, 10) }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="hobby mx-auto">{{ str_limit($headline->hobby, 100) }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="introduction mx-auto">{{ str_limit($headline->introduction, 150) }}</p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str_limit($post->name, 20) }}
                                </div>
                                <div class="gender">
                                    {{ str_limit($post->gender, 20) }}
                                </div>
                                <div class="hobby mt-3">
                                    {{ str_limit($post->hobby, 1500) }}
                                </div>
                                <div class="introduction mt-3">
                                    {{ str_limit($post->introduction, 1500) }}
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