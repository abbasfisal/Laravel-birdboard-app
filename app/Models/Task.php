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


    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {

            $task->project->recordActivity('created_task');

        });

        /* static::updated(function ($task) {

             if (!$task->completed) return;


             $task->project->recordActivity('completed_task');
         });*/

    }

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
    }

}
