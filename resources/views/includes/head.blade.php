<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="format-detection" content="telephone=yes">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
{{-- <script src="//code.jquery.com/jquery-3.3.1.min.js"></script> --}}

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 --}}

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">
<link href='/css/fullcalendar/main.css' rel='stylesheet' />
<script src='/js/fullcalendar/main.js'></script>

@yield('styles')
