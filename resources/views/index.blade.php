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



<div class="text-center">
    <a href="/">
        <img src="/aidoc.jpeg" alt="" class="img-fluid" style="padding: 10px; ">
    </a>
    <hr style="margin: 5px;">
</div>


<div class="container" id="app">

        <form action="/enter-code" method="GET">
            @csrf
            <div class="form-group pb-4">
                <label for="code">Patient Code</label>
                <div class="input-group">
                    <input class="form-control form-control-lg" type="number" id="code" name="code">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Enter</button>
                    </div>
                </div>
            </div>

        </form>

</div>

<!-- Footer -->
<footer class="py-1 bg-secondary">
    <div class="container">
        <p class="m-0 text-center text-white">&copy; {{ date('Y-m-d') }}</p>
    </div>
    <!-- /.container -->
</footer>


{{--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}
{{--<script>--}}
{{--$( document ).ready(function() {--}}
{{--var time = new Date().getTime();--}}
{{--$(document.body).bind("mousemove keypress", function(e) {--}}
{{--time = new Date().getTime();--}}
{{--});--}}

{{--function refresh() {--}}
{{--if(new Date().getTime() - time >= 6000)--}}
{{--window.location.reload(true);--}}
{{--else--}}
{{--setTimeout(refresh, 10000);--}}
{{--}--}}

{{--setTimeout(refresh, 10000);--}}
{{--});--}}
{{--</script>--}}

</body>
</html>
