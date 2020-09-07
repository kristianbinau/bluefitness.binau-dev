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
    public function records(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Record::class, 'exercise_weight_class_id', 'id');
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
        Record::where('exercise_weight_class_id', $id)->delete();

        // delete the user
        return parent::destroy($id);
    }
}
