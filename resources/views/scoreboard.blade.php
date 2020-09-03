@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container">
                @foreach ($data as $table)
                    <label>{{ $table['weightClass']->name .' - '. $table['weightClass']->weight .' kg' }}</label>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Exercise</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Person</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($table['exercises'] as $exercise)
                        <tr>
                            <th scope="row">{{ $exercise['exercise']->name }}</th>
                            <td>{{ $exercise['records'][0]->weight ?? '0' }} kg</td>
                            <td>{{ $exercise['records'][0]['user']->name ?? '' }}</td>
                            <td>{{ isset($exercise['records'][0]->date) === true ? $exercise['records'][0]->date : ''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
