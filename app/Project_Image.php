<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Image extends Model
{
    protected $table = 'project_images';
    public function project() {
        return $this->belongsTo('App\Project');
    }
}
