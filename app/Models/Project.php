<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    function user() {
        return $this->belongsTo('App\Models\User');
    }

    function application() {
        return $this->hasMany('App\Models\Application');
    }

    public function images(){
        return $this->hasMany('App\Models\ProjectImage');
    }

    public function files(){
        return $this->hasMany('App\Models\ProjectFile');
    }

    public function assignedStudents() {
        return $this->hasMany('App\Models\UserStudent');
    }
    
}
