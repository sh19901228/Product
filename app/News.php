<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// NewsクラスはModelクラス(Modelにsaveメソッドが定義されている)を継承
class News extends Model
{
    // 複数代入時にIDの代入を許可しない、同じIDは代入できない
    protected $guarded = array('id');
    // 以下の配列をバリデーションルールとして定義する
    public static $rules = array(
        // タイトルは必須項目
        'title' => 'required',
        // 本文は必須項目
        'body' => 'required',
    );
     // historiesメソッドを定義
    public function histories()
    {
    // newsテーブルに関連付いているhistoriesテーブルを全て取得する
      return $this->hasMany('App\History');

    }
}
