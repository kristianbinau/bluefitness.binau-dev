<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\ExerciseWeightClass;
use App\Record;
use App\User;
use Carbon\Carbon;
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
        return view('admin.home');
    }

    public function record()
    {
        $users = User::select('id', 'name')->cursor();
        $exercises = Exercise::select('id', 'name')->cursor();
        $weightClasses = ExerciseWeightClass::select('id', 'name')->cursor();
        $records = Record::with('exercise')->with('exerciseWeightClass')->with('user')->get();

        return view('admin.record', ['records' => $records, 'users' => $users, 'exercises' => $exercises, 'weightClasses' => $weightClasses,]);
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
        $date = $request['date'] ?? (new Carbon())->format('Y-m-d');

        //  Store data in database
        Record::create(
            [
                'user_id' => $user,
                'exercise_id' => $exercise,
                'exercise_weight_class_id' => $weightClass,
                'weight' => str_replace(',', '.', $weight),
                'date' => $date,
            ]
        );

        return back()->with('success', 'We have added a new record.');
    }

    public function user()
    {
        $users = User::select('id', 'name', 'created_at')->cursor();

        return view('admin.user', ['users' => $users]);
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

        return back()->with('success', 'We have added a new user.');
    }

    public function class()
    {
        $weightClasses = ExerciseWeightClass::select('id', 'name', 'gender', 'weight', 'created_at')->cursor();

        return view('admin.weightClass', ['weightClasses' => $weightClasses]);
    }

    public function storeClass(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:exercise_weight_classes',
            'gender' => 'required',
            'weight' => 'required',
        ]);

        $name = $request['name'];
        $gender = $request['gender'];
        $weight = $request['weight'];

        //  Store data in database
        ExerciseWeightClass::create(
            [
                'name' => $name,
                'gender' => $gender,
                'weight' => $weight,
            ]
        );

        return back()->with('success', 'We have added a new weight class.');
    }

    public function exercise()
    {
        $exercises = Exercise::select('id', 'name', 'gender', 'created_at')->cursor();

        return view('admin.exercise', ['exercises' => $exercises]);
    }

    public function storeExercise(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:exercises',
            'gender' => 'required',
        ]);

        $name = $request['name'];
        $gender = $request['gender'];

        //  Store data in database
        Exercise::create(
            [
                'name' => $name,
                'gender' => $gender,
            ]
        );

        return back()->with('success', 'We have added a new exercise.');
    }
}
