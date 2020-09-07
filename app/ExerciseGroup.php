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

    /**
     * Modify default destroy to also delete exercises
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public static function destroy($id): ?bool
    {
        // delete all related records
        Exercise::where('exercise_group_id', $id)->delete();

        // delete the user
        return parent::destroy($id);
    }
}
