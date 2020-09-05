@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/scoreboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container">
                @foreach ($data as $table)
                    <div class="label-container text-center font-weight-bold mb-3 rounded">
                        <label>{{ $table['weightClass']->name .' - '. $table['weightClass']->weight }}</label>
                    </div>
                    <div class="table-container rounded">

                        <table class="table rounded">
                            <thead class="thead-dark">
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts-append')
    <script>
        var fps = 100;
        var speedFactor = 0.001;
        var minDelta = 0.5;
        var autoScrollSpeed = 10;
        var autoScrollTimer, restartTimer;
        var isScrolling = false;
        var prevPos = 0, currentPos = 0;
        var currentTime, prevTime, timeDiff;

        if (window.location.hash) {
            var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
            if (hash === 'scroll') {
                console.log('scroll')
                window.addEventListener("scroll", function (e) {
                    // window.pageYOffset is the fallback value for IE
                    currentPos = window.scrollY || window.pageYOffset;
                });

                window.addEventListener("wheel", handleManualScroll);
                window.addEventListener("touchmove", handleManualScroll);
                setAutoScroll(20)
            }
        }

        function handleManualScroll() {
            // window.pageYOffset is the fallback value for IE
            currentPos = window.scrollY || window.pageYOffset;
            clearInterval(autoScrollTimer);
            if (restartTimer) {
                clearTimeout(restartTimer);
            }
            restartTimer = setTimeout(() => {
                prevTime = null;
                setAutoScroll();
            }, 50);
        }

        function setAutoScroll(newValue) {
                if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
                     scrolldelay = setTimeout(function () {
                        window.scrollTo(0, 0);
                    },2000);
                }

                if (newValue) {
                    autoScrollSpeed = speedFactor * newValue;
                }
                if (autoScrollTimer) {
                    clearInterval(autoScrollTimer);
                }
                autoScrollTimer = setInterval(function () {
                    currentTime = Date.now();
                    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
                        scrolldelay = setTimeout(function () {
                            window.scrollTo(0, 0);
                        },2000);
                    }
                    if (prevTime) {
                        if (!isScrolling) {
                            timeDiff = currentTime - prevTime;
                            currentPos += autoScrollSpeed * timeDiff;
                            if (Math.abs(currentPos - prevPos) >= minDelta) {
                                isScrolling = true;
                                window.scrollTo(0, currentPos);
                                isScrolling = false;
                                prevPos = currentPos;
                                prevTime = currentTime;
                            }
                        }
                    } else {
                        prevTime = currentTime;
                    }
                }, 1000 / fps);
        }
    </script>
@endsection
