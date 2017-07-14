<?php

namespace Tests\Feature;

use App\Location;
use App\Role;
use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionTest extends TestCase {

  use DatabaseTransactions;

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testAccessAnonymousUser() {
    $this->get('/video')
      ->assertRedirect('login');

    $this->get('/metadata')
      ->assertRedirect('login');

    $this->get('/user')
      ->assertRedirect('login');

    $this->get('/video/create')
      ->assertRedirect('login');

    $this->get('/user/create')
      ->assertRedirect('login');
  }

  /**
   * Test authenticated user without extra roles.
   *
   * @return void
   */
  public function testAuthenticatedUser() {

    $user = factory(User::class)->create();

    $location = factory(Location::class)->create();

    $video = factory(Video::class)->create(['location_id' => $location->id]);

    $this->actingAs($user)
         ->get('/video')
         ->assertStatus(200);

    $this->actingAs($user)
      ->get('/metadata')
      ->assertStatus(200);

    $this->actingAs($user)
      ->get('/user')
      ->assertStatus(200);

    $this->actingAs($user)
      ->get('/user/create')
      ->assertStatus(200);

    // not accessible URL
    $this->actingAs($user)
      ->get('/video/create')
      ->assertStatus(403);

    // Edit video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/edit')
      ->assertStatus(403);

    // Show video
    $this->actingAs($user)
      ->get('/video/' . $video->id)
      ->assertStatus(403);

    // Delete Video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/confirm')
      ->assertStatus(403);
    $this->actingAs($user)
      ->delete('/video/' . $video->id)
      ->assertStatus(403);
  }

  /**
   * Test authenticated user with Play Video role.
   *
   * @return void
   */
  public function testPlayVideoUser() {
    $user = factory(User::class)->create();

    $location = factory(Location::class)->create();

    $video = factory(Video::class)->create(['location_id' => $location->id]);

    $role = Role::where('name', 'video-player')->first();

    $user->roles()->attach($role);

    $this->actingAs($user)
      ->get('/video')
      ->assertStatus(200);

    // not accessible URL
    $this->actingAs($user)
      ->get('/video/create')
      ->assertStatus(403);

    // Edit video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/edit')
      ->assertStatus(403);

    // Show video
    $this->actingAs($user)
      ->get('/video/' . $video->id)
      ->assertStatus(200);

    // Delete Video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/confirm')
      ->assertStatus(403);
    $this->actingAs($user)
      ->delete('/video/' . $video->id)
      ->assertStatus(403);
  }

  /**
   * Test authenticated user with Video Editor role.
   *
   * @return void
   */
  public function testEditVideoUser() {
    $user = factory(User::class)->create();

    $location = factory(Location::class)->create();

    $video = factory(Video::class)->create(['location_id' => $location->id]);

    $role = Role::where('name', 'video-editor')->first();

    $user->roles()->attach($role);

    $this->actingAs($user)
      ->get('/video')
      ->assertStatus(200);

    // not accessible URL
    $this->actingAs($user)
      ->get('/video/create')
      ->assertStatus(200);

    // Edit video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/edit')
      ->assertStatus(200);

    // Show video
    $this->actingAs($user)
      ->get('/video/' . $video->id)
      ->assertStatus(403);

    // Delete Video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/confirm')
      ->assertStatus(403);
    $this->actingAs($user)
      ->delete('/video/' . $video->id)
      ->assertStatus(403);
  }

  /**
   * Test authenticated user with Delete Video role.
   *
   * @return void
   */
  public function testDeleteVideoUser() {
    $user = factory(User::class)->create();

    $location = factory(Location::class)->create();

    $video = factory(Video::class)->create(['location_id' => $location->id]);

    $role = Role::where('name', 'video-delete')->first();

    $user->roles()->attach($role);

    $this->actingAs($user)
      ->get('/video')
      ->assertStatus(200);

    // not accessible URL
    $this->actingAs($user)
      ->get('/video/create')
      ->assertStatus(403);

    // Edit video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/edit')
      ->assertStatus(403);

    // Show video
    $this->actingAs($user)
      ->get('/video/' . $video->id)
      ->assertStatus(403);

    // Delete Video
    $this->actingAs($user)
      ->get('/video/' . $video->id . '/confirm')
      ->assertStatus(200);
    $this->actingAs($user)
      ->delete('/video/' . $video->id)
      ->assertStatus(302);
  }

}
