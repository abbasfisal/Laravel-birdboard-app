<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $old = [];
    //--------------------------


    /******************
     *  Relations
     * *****************/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    /***********************
     * Method`s
     **********************/

    public function path()
    {
        return "/project/{$this->id}";
    }


    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function recordActivity($description)
    {


        $this->activity()->create([

            'description' => $description,

            'changes' => [
                'before' => 'before',
                'after' => 'after'
            ]
        ]);

        /*Activity::query()->create([
            'project_id'=>$this->id ,
            'description'=>$type
        ]);*/
    }

}

