<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exercise_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

    /**
     * Get the child
     */
    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'exercise_group_id', 'id');
    }
}
