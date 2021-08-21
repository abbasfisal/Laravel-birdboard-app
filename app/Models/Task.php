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


    public function activity()
    {
        //subject is name of method in the activity model
        return $this->morphMany(Activity::class, 'subject')->latest();
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
        $this->recordActivity('uncompleted_task');

    }


    public function recordActivity($description)
    {

        $this->activity()->create([
            'project_id' => $this->project_id,
            'description' => $description
        ]);

    }

}
