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


}
