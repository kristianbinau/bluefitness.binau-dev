@extends('layouts.app')

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

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>

        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Exercise</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($exercises as $exercise)
                <tr>
                    <th scope="row">{{ $exercise->id }}</th>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
