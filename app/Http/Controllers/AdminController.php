<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\ExerciseWeightClass;
use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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

    public function index()
    {
        return view('admin');
    }

    public function record()
    {
        $users = User::select('id', 'name')->cursor();
        $exercises = Exercise::select('id', 'name')->cursor();
        $weightClasses = ExerciseWeightClass::select('id', 'name')->cursor();
        $records = Record::with('exercise')->with('exerciseWeightClass')->with('user')->get();

        return view('adminRecord', ['records' => $records, 'users' => $users, 'exercises' => $exercises, 'weightClasses' => $weightClasses,]);
    }

    public function storeRecord(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'exercise' => 'required',
            'weightClass' => 'required',
            'weight' => 'required',
        ]);


        $user = $request['user'];
        $exercise = $request['exercise'];
        $weightClass = $request['weightClass'];
        $weight = $request['weight'];

        //  Store data in database
        Record::create(
            [
                'user_id' => $user,
                'exercise_id' => $exercise,
                'exercise_weight_class_id' => $weightClass,
                'weight' => $weight,
            ]
        );

        //
        return back()->with('success', 'We have added a new record.');
    }

    public function user()
    {
        $users = User::select('id', 'name', 'created_at')->cursor();

        return view('adminUser', ['users' => $users]);
    }

    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users',
        ]);

        $name = $request['name'];
        $mail = str_replace(' ', '', $request['name']). '@bluefitness.binau.dev';
        $pass = 'dummypass';

        //  Store data in database
        User::create(
            [
                'name' => $name,
                'email' => $mail,
                'password' => $pass,
            ]
        );

        //
        return back()->with('success', 'We have added a new user.');
    }

    public function class()
    {
        $weightClasses = ExerciseWeightClass::select('id', 'name', 'type', 'gender', 'age_from', 'age_to', 'weight_from', 'weight_to', 'created_at')->cursor();

        return view('adminClass', ['weightClasses' => $weightClasses]);
    }

    public function storeClass(Request $request)
    {
        // Handling changing of types
        if ($request['send'] !== 'Submit') {
            return back()->with('type', $request['type'])->with('name', $request['name']);
        }

        $this->validate($request, [
            'name' => 'required|unique:exercise_weight_classes',
            'type' => 'required',
        ]);

        $name = $request['name'];
        $type = strtolower($request['type']);
        $gender = $request['gender'];
        $ageFrom = $request['ageFrom'];
        $ageTo = $request['ageTo'];
        $weightFrom = $request['weightFrom'];
        $weightTo = $request['weightTo'];

        // Handling of different types and what needs to be required
        if ($type === 'age') {
            try {
                $this->validate($request, [
                    'ageFrom' => 'required',
                    'ageTo' => 'required',
                ]);
            } catch (ValidationException $e) {
                return back()->with('error', 'The "Age From" & "Age To" field is required');
            }
        } elseif ($type === 'weight') {
            try {
                $this->validate($request, [
                    'weightFrom' => 'required',
                    'weightTo' => 'required',
                ]);
            } catch (ValidationException $e) {
                return back()->with('error', 'The "Weight From" & "Weight To" field is required.');
            }
        } elseif ($type === 'gender') {
            try {
                $this->validate($request, [
                    'gender' => 'required',
                ]);
            } catch (ValidationException $e) {
                return back()->with('error', 'The "Gender" field is required.');
            }
        }

        //  Store data in database
        ExerciseWeightClass::create(
            [
                'name' => $name,
                'type' => $type,
                'gender' => $gender,
                'age_from' => $ageFrom,
                'age_to' => $ageTo,
                'weight_from' => $weightFrom,
                'weight_to' => $weightTo,
            ]
        );

        //
        return back()->with('success', 'We have added a new weight class.');
    }

    public function exercise()
    {
        $exercises = Exercise::select('id', 'name', 'created_at')->cursor();

        return view('adminExercise', ['exercises' => $exercises]);
    }

    public function storeExercise(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:exercises',
        ]);

        $name = $request['name'];

        //  Store data in database
        Exercise::create(
            [
                'name' => $name,
            ]
        );

        //
        return back()->with('success', 'We have added a new exercise.');
    }
}
