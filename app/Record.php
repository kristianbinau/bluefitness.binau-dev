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
    protected $fillable = ['id', 'user_id', 'exercise_id', 'weight'];

    /**
     * Get the parent
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'id', 'exercise_id');
    }

    /**
     * Get the parent
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
