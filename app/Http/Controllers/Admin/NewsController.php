<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Newsモデルを使用する宣言
use App\News;
// Historyモデルを使用する宣言
use App\History;
use Carbon\Carbon;
class NewsController extends Controller
{
    public function add()
    {
    // admin/newsディレクトリ配下のcreate.blade.phpファイルを表示
        return view('admin.news.create');
    }
    
    // Requestクラス(設計図)をもとにして作られたデータ(フォームで入力した情報だけでなく、ユーザーから送られる全ての情報)が入っている$requestインスタンス
    public function create(Request $request)
    {
    // 上記の$requestデータをNewsモデルの配列$rules(タイトルと本文は必須項目)を呼び出してバリデーションを実行
    $this->validate($request, News::$rules);
    // バリデーションでエラーが無ければ、Newsモデル(IDは自動生成、タイトル、本文)を$news(newsテーブル、厳密にはレコード)に代入
    $news = new News;
    // フォームでユーザーが入力したデータを$formに代入
    $form = $request->all();
    // ユーザーが入力したデータ($form)から画像が送信されてきたら
      if (isset($form['image'])) {
        // 画像を読み込んで、public/imageディレクトリに保存し、$pathに代入
        $path = $request->file('image')->store('public/image');
        // newsテーブルのimage_pathカラムに$path(public/image/〇〇〇.jpg)のファイル名だけを代入
        $news->image_path = basename($path);
      } else {
        // 画像が送信されてこなかったら、newsテーブルのimage_pathカラムにnullを代入する
          $news->image_path = null;
      }
    // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    // フォームから送信されてきたimageを削除する
    unset($form['image']);
    // $formの中のプロパティ(タイトル、本文、image_path)にデータが入ったので、newsテーブルに代入し、保存する
    $news->fill($form);
    $news->save();
    // admin/news/create.blade.phpにリダイレクトする
        return redirect('admin/news/create');
    }
    
    // データを一覧表示
    public function index(Request $request)
    {
      // 一覧画面にある検索ボックスの中のデータを$cond_titleに代入
      $cond_title = $request->cond_title;
      // 検索ボックスでユーザーが検索したら
      if ($cond_title != '') {
          // newsテーブルの中のtitleカラムで$cond_title(検索した文字)に一致するレコードを取得
          // 取得したレコードを$posts変数に代入
          $posts = News::where('title', $cond_title)->get();
      } else {
          // 検索ボックスで検索していなかったら、newsテーブルのすべてのレコードを取得し、$postsに代入
          $posts = News::all();
      }
      // admin/news/index.blade.phpを表示する
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    // 編集画面
    public function edit(Request $request)
    {
      // Newsモデル(保存してあるユーザーデータ)の中のIDを取得し、$newsテーブルに代入
      $news = News::find($request->id);
      // newsテーブルの中にデータが無ければ、404エラーを表示させる
      if (empty($news)) {
        abort(404);    
      }
      // admin/news/edit.blade.phpを表示する
      return view('admin.news.edit', ['news_form' => $news]);
    }
    
    // 編集画面から送信されたデータを処理
    public function update(Request $request)
    {
      // $requestデータをNewsモデルrulesに沿ってValidationをかける
      $this->validate($request, News::$rules);
      // Newsモデルからユーザーデータの中のIDを取得し、$newsに代入
      $news = News::find($request->id);
      // ユーザーが送信したフォームデータを$news_formに代入
      $news_form = $request->all();
      // 画像が送信されてきたら
      if (isset($news_form['image'])) {
        // 画像を読み込んで、public/imageディレクトリに保存し、$pathに代入
        $path = $request->file('image')->store('public/image');
        // Newsテーブルのimage_pathカラムに$path(public/image/〇〇〇.jpg)のファイル名だけを保存
        $news->image_path = basename($path);
        // 画像を削除(データベースに画像そのものを保存できない)
        unset($news_form['image']);
      } 
      // 画像が送信されず、ユーザーデータの中のremove(削除ボタン)が送信されてきたら、newsテーブルのimage_pathカラムにnullを代入
      elseif (isset($request->remove)) {
        $news->image_path = null;
        // $news_formから送信されてきた'remove'を削除
        unset($news_form['remove']);
      }
      // トークンを削除
      unset($news_form['_token']);
      // 該当するデータ(title・body)を上書きして保存する
      $news->fill($news_form)->save();
      
      // Historyモデルのデータを$historyに代入
      $history = new History;
      // $newsのIDカラムを$historyのnews_idカラムに代入
      $history->news_id = $news->id;
      // 現在時刻を$historyのedited_atカラムに代入
      $history->edited_at = Carbon::now();
      // 保存する
      $history->save();
      // admin/news(ニュース一覧)にリダイレクト
      return redirect('admin/news/');
    }
    
    public function delete(Request $request)
    {
      // Newsモデルからユーザーデータの中のIDを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      // admin/news(ニュース一覧)にリダイレクト
      return redirect('admin/news/');
    }  
}
