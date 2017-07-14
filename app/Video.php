<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

  /**
   * Get the tags associated to the Video
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function tags() {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }

  /**
   * An video belongs to one location.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function location() {
    return $this->belongsTo(Location::class);
  }

  /**
   * Get likes from this video
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function likes() {
    return $this->belongsToMany(User::class)->withTimestamps();
  }

  /**
   * Determine if the current video has been liked.
   *
   * @return boolean
   */
  public function isLiked() {
    return $this->likes()->where('user_id', auth()->id())->exists() ? 1 : 0;
  }

  /**
   * Get the number of likes for the video.
   *
   * @return integer
   */
  public function likesCount() {
    return $this->likes->count();
  }

  public function __get($key) {
    if (in_array($key, ['isLiked', 'likesCount'])) {
      return $this->$key();
    }
    return parent::__get($key);
  }

}
