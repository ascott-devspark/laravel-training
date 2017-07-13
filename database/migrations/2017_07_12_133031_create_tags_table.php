<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tags', function (Blueprint $table) {
      $table->increments('id');

      // Fields
      $table->string('name');
      $table->timestamps();
    });

    Schema::create('tag_video', function (Blueprint $table) {
      $table->integer('video_id')->unsigned()->index();
      $table->integer('tag_id')->unsigned()->index();
      $table->timestamps();

      // Relations
      $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
      $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

    }); // videos and tags
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tags');
    Schema::dropIfExists('video_tag');
  }
}
