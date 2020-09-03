<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // historiesという名前のテーブルを作成、以下、データ項目のカラムも作成
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id');
            $table->string('edited_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ロールバック時、historiesというテーブルが存在すれば、削除する
        Schema::dropIfExists('histories');
    }
}
