<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// CreateProfilesTableクラスはMigrationクラスを継承する
class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // profilesという名前のテーブルを作成
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            // stringは文字列型のカラム
            $table->string('name');
            $table->string('gender');
            $table->string('hobby');
            $table->string('introduction');
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
        // ロールバック時、profilesという名前のテーブルが存在すれば削除する
        Schema::dropIfExists('profiles');
    }
}
