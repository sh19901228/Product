<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\News;
// NewsControllerクラスはControllerクラスを継承
class NewsController extends Controller
{
    // Requestクラスから作られた$requestインスタンス(ユーザーの全ての情報)
    public function index(Request $request)
    {
        // 全てのNewsテーブルの中から、投稿日時順に新しい方から並べて$postsに代入
        $posts = News::all()->sortByDesc('updated_at');
        // $postsにデータがあれば、最新の記事を$headlineに代入
        if (count($posts) > 0) {
            $headline = $posts->shift();
        // $postsにデータが無ければ、$headlineにnullを代入
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
