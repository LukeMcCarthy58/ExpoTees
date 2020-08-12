<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor_Student_Link extends Model
{
    protected $table = 'supervisor_student_link';
    public function user() {
        return $this->belongsTo('App\User');
    }
}
