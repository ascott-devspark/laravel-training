<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('user_video', function (Blueprint $table) {
      $table->integer('video_id')->unsigned()->index();
      $table->integer('user_id')->unsigned()->index();
      $table->timestamps();

      // Relations
      $table->foreign('video_id')
        ->references('id')
        ->on('videos')
        ->onDelete('cascade');
      $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('likes');
  }
}
