<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Create roles
      $player = new Role();
      $player->name         = 'video-player';
      $player->display_name = 'Video Player';
      $player->description  = 'User can play videos';
      $player->save();

      $creator = new Role();
      $creator->name         = 'video-editor';
      $creator->display_name = 'Video Editor'; // optional
      $creator->description  = 'User can create or edit videos'; // optional
      $creator->save();

      $deleter = new Role();
      $deleter->name         = 'video-delete';
      $deleter->display_name = 'Video Deleter'; // optional
      $deleter->description  = 'User can delete videos'; // optional
      $deleter->save();

      // Create Permission
      $playVideo = new Permission();
      $playVideo->name         = 'play-video';
      $playVideo->display_name = 'Play Video';
      $playVideo->save();

      $editVideo = new Permission();
      $editVideo->name         = 'add-edit-video';
      $editVideo->display_name = 'Create/Edit Video';
      $editVideo->save();

      $delVideo = new Permission();
      $delVideo->name         = 'delete-video';
      $delVideo->display_name = 'Delete Video';
      $delVideo->save();

      // Attach permission to role
      $player->attachPermission($playVideo);
      $creator->attachPermission($editVideo);
      $deleter->attachPermission($delVideo);
    }
}
