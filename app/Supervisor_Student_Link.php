<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor_Student_Link extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
}
