<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Image extends Model
{
    protected $table = 'project_images';
    //protected  $primaryKey = 'project_image_id';

    public function project() {
        return $this->belongsTo('App\Project');
    }
}
