<!DOCTYPE html>
<html lang="pt-br" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.:.Best Soccer - O seu Site de Aposta.:.</title>

    <!-- Fonts -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
    {!! Html::style('css/default.css') !!}
    {!! Html::style('css/component.css') !!}
    {!! Html::style('css/css/component.css') !!}
    {!! Html::style('css/flexselect.css') !!}
    {!! Html::style('css/cs-select.css') !!}
    {!! Html::style('css/cs-skin-underline.css') !!}
    {!! Html::script('/js/jquery.min.js') !!}
    {!! Html::script('/js/liquidmetal.js') !!}
    {!! Html::script('/js/jquery.flexselect.js') !!}
    {!! Html::script('/js/selectFx.js') !!}



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700"/>

    <!-- Styles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/> -->

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <!-- Latest compiled and minified JavaScript -->

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    
</script>
</head>
<body id="app-layout">

   @include('layouts._includes._nav')

   @if(Session::has('flash_message'))
   <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div align="center" class="alert {{ Session::get('flash_message')['class'] }}">
             {{ Session::get('flash_message')['msg'] }}

         </div>
     </div>
 </div>
</div>

@endif

@yield('content')

<!-- JavaScripts -->
<!-- JavaScripts

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
-->

{!! Html::script('/js/moment.min.js') !!}
{!! Html::script('/js/collapse.js') !!}
{!! Html::script('/js/transition.js') !!}
{!! Html::script('/js/bootstrap.min.js') !!}
{!! Html::script('/js/bootstrap-datetimepicker.min.js') !!}
{!! Html::script('/js/date.js') !!}
{!! Html::script('/js/form.js') !!}
{!! Html::script('/js/modernizr.custom.js') !!}
{!! Html::script('/js/classie.js') !!}
{!! Html::script('/js/modalEffects.js') !!}

<script>
    // this is important for IEs
    var polyfilter_scriptpath = '/js/';

    (function() {
        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {    
            new SelectFx(el);
        } );
    })();
   
</script>
{!! Html::script('/js/cssParser.js') !!}
{!! Html::script('/js/css-filters-polyfill.js') !!}
{!! Html::script('http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js') !!}
{!! Html::script('js/js/jquery.stickyheader.js') !!}

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
