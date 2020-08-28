<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exercises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'exercise_group_id'];

    /**
     * Get the parent
     */
    public function group()
    {
        return $this->belongsTo(ExerciseGroup::class, 'id', 'exercise_group_id');
    }

    /**
     * Get the child
     */
    public function records()
    {
        return $this->hasMany(Record::class, 'exercise_id', 'id');
    }
}
