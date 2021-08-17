<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];



    /**********************
     * Relation
     * ********************/
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    /*****************
     * Method`s
     ******************/

    public function path()
    {
        return 'project/' . $this->project->id . '/tasks/' . $this->id;
    }

    public function complete()
    {
        $this->update([
            'completed' => true
        ]);
        $this->project->recordActivity('completed_task');

    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('uncompleted_task');

    }

}
