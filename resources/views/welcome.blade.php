<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AiDoc.Online</title>
        <meta name="description" content="Ai Doctor Online - Diagnosis">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="/icon_512.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#255cd3">


    </head>
    <body>

        {{--<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">--}}
            {{--<div class="container">--}}
                {{--<a class="navbar-brand  ml-1" href="/">AiDoc.Online</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}
                {{--<div class="collapse navbar-collapse" id="navbarResponsive">--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                        {{--<li class="nav-item active">--}}
                            {{--<a class="nav-link" href="/">Home--}}
                                {{--<span class="sr-only">(current)</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        <div class="text-center">
            <a href="/">
                <img src="/aidoc.jpeg" alt="" class="img-fluid" style="padding: 10px; ">
            </a>
            <hr style="margin: 5px;">
        </div>


        <div class="container" id="app">

            @if(isset($pacient))
                <div class="jumbotron">
                    <h4 class="display-5">{{ $pacient->name }} <a class="btn btn-secondary pull-right" href="/" role="button">Back</a></h4>

                </div>
            @else
            <form action="/enter-code" method="POST">
                @csrf
                <div class="form-group pb-4">
                    <label for="code">Client Code</label>
                    <div class="input-group">
                        <input class="form-control form-control-lg" type="number" id="code" name="code">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Enter</button>
                        </div>
                    </div>
                </div>

            </form>
            @endif

            @if(isset($minutes))
            <div class="jumbotron text-center">
                <h1 class="display-4">{{ $minutes }} Minutes</h1>
            </div>
            @endif

            @if(isset($pacient_symptoms))
                <ul class="list-group">
                @foreach($pacient_symptoms as $symptom)
                    <li class="list-group-item">{{ str_replace("_", " ", $symptom) }}</li>
                @endforeach
                </ul>
            @endif

            <br>

            @if(isset($test_data))
            <symptoms symptoms="{{ json_encode($test_data) }}"></symptoms>
            @endif
        </div>

        <!-- Footer -->
        <footer class="py-1 bg-secondary">
            <div class="container">
                <p class="m-0 text-center text-white">&copy; {{ date('Y-m-d') }}</p>
            </div>
            <!-- /.container -->
        </footer>

        <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
