<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // 外部キー (categoriesテーブルのid)
            $table->unsignedBigInteger('category_id');

            // 名前・連絡先など
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender'); // 1:男性, 2:女性, 3:その他
            $table->string('email')->unique();
            $table->string('tel1');
            $table->string('tel2');
            $table->string('tel3');

            $table->string('address')->nullable();
            $table->string('building')->nullable();
            $table->text('message'); // 内容

            $table->timestamps();

            // 外部キー制約
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
