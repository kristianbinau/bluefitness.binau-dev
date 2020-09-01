<?php

namespace App\Http\Controllers\Api;

use App\ExerciseWeightClass;
use App\Http\Controllers\Controller;
use App\Exercise;
use App\Record;
use App\User;

class AdminApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteExercise($id) {
        $status = Exercise::destroy($id);

        if ($status === 1) {
            return response()->json('Succes - Deleted ' . $status . ' row(s) from Exercises', '200');
        }

        return response()->json('Failure - Deleted ' . $status .  ' row(s) from Exercises', '404');
    }

    public function deleteUser($id) {
        $status = User::destroy($id);

        if ($status === 1) {
            return response()->json('Succes - Deleted ' . $status . ' row(s) from Users', '200');
        }

        return response()->json('Failure - Deleted ' . $status .  ' row(s) from Users', '404');
    }

    public function deleteRecord($id) {
        $status = Record::destroy($id);

        if ($status === 1) {
            return response()->json('Succes - Deleted ' . $status . ' row(s) from Records', '200');
        }

        return response()->json('Failure - Deleted ' . $status .  ' row(s) from Records', '404');
    }

    public function deleteClass($id) {
        $status = ExerciseWeightClass::destroy($id);

        if ($status === 1) {
            return response()->json('Succes - Deleted ' . $status . ' row(s) from ExerciseWeightClasses', '200');
        }

        return response()->json('Failure - Deleted ' . $status .  ' row(s) from ExerciseWeightClasses', '404');
    }
}
