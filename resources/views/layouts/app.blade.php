<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('page_title') - Ethvatar</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-kit.css?v=2.1.0') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top @if( url()->current() == url('/') ) navbar-transparent @endif" color-on-scroll="300">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="{{ url('/') }}">Ethvatar</a>
                <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">
                            What is Ethvatar?
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/api') }}">
                            For Developers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/app') }}" class="btn btn-danger btn-round">Try now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="wrapper">
        @yield('body')
    </div>



    <!-- Modal Bodies come here -->
    <div class="loading" id="loading"></div>
    <!--   end modal -->


</body>
<!-- Core JS Files -->
<script src="{{ asset('assets/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Switches -->
<script src="{{ asset('assets/js/bootstrap-switch.min.js') }}"></script>

<!--  Plugins for Slider -->
<script src="{{ asset('assets/js/nouislider.js') }}"></script>

<!--  Plugins for DateTimePicker -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{ asset('assets/js/paper-kit.js?v=2.1.0') }}"></script>

<!-- IPFS -->
<script src="{{ asset('dapp/buffer.js') }}"></script>
<script src="{{ asset('dapp/ipfs.api.js') }}"></script>

<!-- APPLICATION -->
<script src="{{ asset('dapp/application.js') }}"></script>

<script>
    var interval = 1500;
    setInterval(function(){
        $('#loading').fadeOut();
        interval = 999999999999999;
    }, interval);
</script>
</html>