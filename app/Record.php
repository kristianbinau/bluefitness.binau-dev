<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'exercise_id', 'exercise_weight_class_id', 'weight', 'date'];

    /**
     * Get the parent
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }

    /**
     * Get the parent
     */
    public function exerciseWeightClass()
    {
        return $this->belongsTo(ExerciseWeightClass::class, 'exercise_weight_class_id', 'id');
    }

    /**
     * Get the parent
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
