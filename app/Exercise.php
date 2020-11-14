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
    protected $fillable = ['id', 'name', 'gender', 'exercise_group_id'];

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
    public function records(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Record::class, 'exercise_id', 'id');
    }

    /**
     * Modify default destroy to also delete records
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public static function destroy($id): ?bool
    {
        // delete all related records
        Record::where('exercise_id', $id)->delete();

        // delete the user
        return parent::destroy($id);
    }
}
