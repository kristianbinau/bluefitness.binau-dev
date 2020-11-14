@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <form action="" method="post" action="{{ route('AdminExerciseStore') }}">

            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name">

                <!-- Error -->
                @if ($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select required class="form-control {{ $errors->has('gender') ? 'error' : '' }}"
                        name="gender"
                        id="gender">
                    <option disabled hidden selected>Select a Gender</option>
                    <option value="Men" >Men</option>
                    <option value="Women" >Women</option>
                    <option value="All" >All</option>
                </select>

                <!-- Error -->
                @if ($errors->has('gender'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>

        <exercise-table data="{{ $exercises }}" ></exercise-table>
    </div>
@endsection
