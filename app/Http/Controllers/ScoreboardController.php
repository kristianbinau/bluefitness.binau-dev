<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\ExerciseWeightClass;
use App\Record;

class ScoreboardController extends Controller
{
    public function index()
    {
        $data = [];
        $weightClasses = ExerciseWeightClass::select('id', 'name', 'gender', 'weight')->cursor();
        foreach ($weightClasses as $weightClass) {
            $data[] = [
                'weightClass' => $weightClass,
                'exercises' => [],
            ];
            $weightClassId = $weightClass['id'];
            $weightClassGender = $weightClass['gender'];
            $exercises = Exercise::select('id', 'name', 'gender')->where('gender', '=', $weightClassGender)->orWhere('gender', '=', 'All')->cursor();
            foreach ($exercises as $exercise) {
                $exerciseId = $exercise['id'];
                $records = Record::where('exercise_weight_class_id', '=', $weightClassId)->where('exercise_id', '=', $exerciseId)->with('exercise')->with('exerciseWeightClass')->with('user')->orderBy('weight', 'desc')->get();
                $data[(count($data) - 1)]['exercises'][] =
                    [
                        'exercise' => $exercise,
                        'records' => $records,
                    ];
            }
        }

        return view('scoreboard', ['data' => $data,]);
    }
}
