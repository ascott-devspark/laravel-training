<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
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
      return $this->belongsToMany(Like::class);
    }

}
