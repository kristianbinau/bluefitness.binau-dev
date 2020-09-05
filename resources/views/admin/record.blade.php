@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <form action="" method="post" action="{{ route('AdminRecordStore') }}">

            @csrf

            <div class="form-group">
                <label>User</label>
                <select required class="form-control {{ $errors->has('user') ? 'error' : '' }}"
                        name="user"
                        id="user">
                    <option disabled hidden selected>Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                <!-- Error -->
                @if ($errors->has('type'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Exercise</label>
                <select required class="form-control {{ $errors->has('exercise') ? 'error' : '' }}"
                        name="exercise"
                        id="exercise">
                    <option disabled hidden selected>Select a exercise</option>
                    @foreach ($exercises as $exercise)
                        <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                    @endforeach
                </select>

                <!-- Error -->
                @if ($errors->has('type'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Weight Class</label>
                <select required class="form-control {{ $errors->has('weightClass') ? 'error' : '' }}"
                        name="weightClass"
                        id="weightClass">
                    <option disabled hidden selected>Select a weight class</option>
                    @foreach ($weightClasses as $weightClass)
                        <option value="{{ $weightClass->id }}">{{ $weightClass->name }}</option>
                    @endforeach
                </select>

                <!-- Error -->
                @if ($errors->has('type'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Weight</label>
                <input type="text" class="form-control {{ $errors->has('weight') ? 'error' : '' }}"
                       name="weight"
                       id="weight">

                <!-- Error -->
                @if ($errors->has('weight'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Date - (Format: YYYY-MM-DD)</label>
                <input type="text" class="form-control {{ $errors->has('date') ? 'error' : '' }}"
                       name="date"
                       id="date">

                <!-- Error -->
                @if ($errors->has('date'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>

        <record-table data="{{ $records }}" ></record-table>
    </div>
@endsection
