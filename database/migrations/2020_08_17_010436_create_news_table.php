<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// CreateNewsTableクラスはMigrationクラスを継承している
class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::createでテーブル作成、第1引数にテーブル名のnews、function以下は定型文
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id'); // IDを保存するカラム
            $table->string('title'); // ニュースのタイトルを保存するカラム
            $table->string('body');  // ニュースの本文を保存するカラム
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム(nullableは、画像のパスが空でも保存出来るという意味)
            $table->timestamps(); // タイムスタンプを保存するカラム(自動で埋まる)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ロールバック時、newsテーブルが存在すれば削除する
        Schema::dropIfExists('news');
    }
}
