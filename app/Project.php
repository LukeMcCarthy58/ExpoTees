<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;
    protected  $primaryKey = 'project_id';
    //A project belongs to a user
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function projectImage() {
        return $this->hasOne('App\Project_Image');
    }
}
