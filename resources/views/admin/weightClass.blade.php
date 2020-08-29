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

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>

        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Gender</th>
                <th scope="col">Weight</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($weightClasses as $weightClass)
                <tr>
                    <th scope="row">{{ $weightClass->id }}</th>
                    <td>{{ $weightClass->name }}</td>
                    <td>{{ $weightClass->gender }}</td>
                    <td>{{ $weightClass->weight }}</td>
                    <td>{{ $weightClass->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
