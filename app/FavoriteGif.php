<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteGif extends Model
{
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
