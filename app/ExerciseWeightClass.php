<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseWeightClass extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exercise_weight_classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'gender', 'weight'];

    /**
     * Get the child
     */
    public function records()
    {
        return $this->hasMany(Record::class, 'exercise_id', 'id');
    }
}
