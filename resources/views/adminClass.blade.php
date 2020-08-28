@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif

    <!-- Error message -->
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif

        <form action="" method="post" action="{{ route('AdminClassStore') }}">

            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                       name="name"
                       id="name"
                       value="{{ Session::get('name') }}">

                <!-- Error -->
                @if ($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Type</label>
                <select required class="form-control {{ $errors->has('type') ? 'error' : '' }}"
                        onchange="this.form.submit()"
                        name="type"
                        id="type">
                    <option {{ Session::has('type') ? 'disabled hidden ' : 'disabled hidden selected' }}>Select a Type</option>
                    <option {{ Session::get('type') === 'Age' ? 'selected' : '' }} value="Age" >Age</option>
                    <option {{ Session::get('type') === 'Weight' ? 'selected' : '' }} value="Weight" >Weight</option>
                    <option {{ Session::get('type') === 'Gender' ? 'selected' : '' }} value="Gender" >Gender</option>
                </select>

                <!-- Error -->
                @if ($errors->has('type'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            @if (Session::has('type'))
                @switch(Session::get('type'))
                    @case('Age')
                    <div class="form-group">
                        <label>Age From</label>
                        <input type="text" class="form-control {{ $errors->has('ageFrom') ? 'error' : '' }}"
                               name="ageFrom"
                               id="ageFrom">

                        <!-- Error -->
                        @if ($errors->has('ageFrom'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('ageFrom') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Age To</label>
                        <input type="text" class="form-control {{ $errors->has('ageTo') ? 'error' : '' }}"
                               name="ageTo"
                               id="ageTo">

                        <!-- Error -->
                        @if ($errors->has('ageTo'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('ageTo') }}
                            </div>
                        @endif
                    </div>
                    @break

                    @case('Weight')
                    <div class="form-group">
                        <label>Weight From</label>
                        <input type="text" class="form-control {{ $errors->has('weightFrom') ? 'error' : '' }}"
                               name="weightFrom"
                               id="weightFrom">

                        <!-- Error -->
                        @if ($errors->has('weightFrom'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('weightFrom') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Weight To</label>
                        <input type="text" class="form-control {{ $errors->has('weightTo') ? 'error' : '' }}"
                               name="weightTo"
                               id="weightTo">

                        <!-- Error -->
                        @if ($errors->has('weightTo'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('weightTo') }}
                            </div>
                        @endif
                    </div>
                    @break
                    @case('Gender')
                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control {{ $errors->has('gender') ? 'error' : '' }}"
                               name="gender"
                               id="gender">

                        <!-- Error -->
                        @if ($errors->has('gender'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>
                    @break
                    @default
                @endswitch
            @endif

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>

        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Type</th>
                <th scope="col">Gender</th>
                <th scope="col">Age From</th>
                <th scope="col">Age To</th>
                <th scope="col">Weight From</th>
                <th scope="col">Weight To</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($weightClasses as $weightClass)
                <tr>
                    <th scope="row">{{ $weightClass->id }}</th>
                    <td>{{ $weightClass->name }}</td>
                    <td>{{ $weightClass->type }}</td>
                    <td>{{ $weightClass->gender }}</td>
                    <td>{{ $weightClass->age_from }}</td>
                    <td>{{ $weightClass->age_to }}</td>
                    <td>{{ $weightClass->weight_from }}</td>
                    <td>{{ $weightClass->weight_to }}</td>
                    <td>{{ $weightClass->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
