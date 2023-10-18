<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    function user() {
        return $this->belongsTo('App\Models\User');
    }

    function project() {
        return $this->belongsTo('App\Models\Project');
    }
}
