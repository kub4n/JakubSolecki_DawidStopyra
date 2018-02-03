<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdColumnToPostTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('blog__posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('blog__posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
