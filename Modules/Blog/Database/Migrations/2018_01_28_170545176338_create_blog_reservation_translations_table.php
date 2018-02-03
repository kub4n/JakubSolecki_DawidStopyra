<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogReservationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog__reservation_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('owner_id');
            $table->string('data')->nulable();
            $table->string('comment_ask')->nulable();
            $table->string('comment_reply')->nulable();
            $table->integer('status')->nulable();

            $table->integer('reservation_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['reservation_id', 'locale']);
            $table->foreign('reservation_id')->references('id')->on('blog__reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog__reservation_translations', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
        });
        Schema::dropIfExists('blog__reservation_translations');
    }
}
