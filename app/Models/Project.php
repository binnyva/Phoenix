<?php
namespace App\Models;

use App\Models\Common;
use App\Models\Classes;
use App\Models\Batch;

final class Project extends Common
{
    protected $table = 'Project';
    public $timestamps = false;

    public function classes($search)
    {
        $q = $this->hasMany('App\Models\Classes', 'project_id');
        $classes = (new Classes)->baseSearch($search, $q);
        return $classes;
    }

    public function batches($search)
    {
        $q = $this->hasMany('App\Models\Batch', 'project_id');
        $batches = (new Batch)->baseSearch($search, $q);
        return $batches;
    }
    
    public function fetch($id)
    {
        $this->id = $id;
        $this->item = $this->find($id);

        return $this->item;
    }

    public static function getAll()
    {
        return Project::select('id', 'name')->where('status', '1')->get();
    }
}
