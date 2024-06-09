<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReviewsTableAddCascade extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);
            $table->foreign('movie_id')
                  ->references('id')->on('movies')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);
            $table->foreign('movie_id')
                  ->references('id')->on('movies');
        });
    }
}
