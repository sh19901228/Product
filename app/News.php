<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// NewsクラスはModelクラスを継承
class News extends Model
{
    // 複数代入時にIDの代入を許可しない
    protected $guarded = array('id');
    // 以下の配列をバリデーションルールとして定義する
    public static $rules = array(
        // タイトルは必須項目
        'title' => 'required',
        // 本文は必須項目
        'body' => 'required',
    );
     // historiesメソッドを呼び出す、つまりNewsモデルに関連付けを行う
    public function histories()
    {
    // Historyモデルも所有している
      return $this->hasMany('App\History');

    }
}
