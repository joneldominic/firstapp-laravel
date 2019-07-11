<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Setting Table Name
    protected $table = 'posts';

    // Setting Primary Key
    public $primaryKey = 'id';

    // Timestamps (True - to be updated | False - ...)
    public $timestamps = true;

    // Creating Relations - Post has a relationship with User and belongs to a user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
