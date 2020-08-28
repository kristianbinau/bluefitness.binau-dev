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
                    <option {{ Session::get('type') === 'Age' ? 'selected' : '' }} >Age</option>
                    <option {{ Session::get('type') === 'Weight' ? 'selected' : '' }} >Weight</option>
                    <option {{ Session::get('type') === 'Gender' ? 'selected' : '' }} >Gender</option>
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
    </div>
@endsection
