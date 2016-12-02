<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }
}
