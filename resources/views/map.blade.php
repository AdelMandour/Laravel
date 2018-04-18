<!DOCTYPE html>
<html>
    <head>
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Employees</title>
        
            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title></title>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBoFuIsuiqN3KQlMOXXMshFtXoFAX17KdM"></script>
        <script>
        window.addEventListener('load',function(){
        var myLatlng = new google.maps.LatLng(30.044281, 31.340002);
        var myOptions = {
        zoom: 6,
        center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        var geocoder = new google.maps.Geocoder();
        google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng,map);
        sleep(7000);
        geocoder.geocode({
                    'latLng': event.latLng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    if (window.location.href.split("?")[1].split("=")[1]=="create"){
                        window.location = "employees/create?address="+results[0].formatted_address;
                    }
                    else{
                        window.location = "employees/"+window.location.href.split("&")[1].split("=")[1]+"/edit?address="+results[0].formatted_address;
                    }
                }
            }
            });
        });
        })
        function addMarker(location,map){
            var marker = new google.maps.Marker({
                position: location,
                label: "you clicked here",
                map: map
            });
        }
        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds){
                    break;
                }
            }
        }
        </script>
        <style>
            #map{
                width:600px;
                height:600px;
                margin: auto;
            }
            .showmap{
                border: 2px solid darkmagenta;
                margin: auto;
                border-radius: 25px;
                box-shadow: aquamarine 0px 0px 120px;
            }
        </style>
    </head>
    <body>
            <div id="app">
                    <nav class="navbar navbar-default navbar-static-top">
                        <div class="container">
                            <div class="navbar-header">
            
                                <!-- Collapsed Hamburger -->
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
            
                                <!-- Branding Image -->
                                <a class="navbar-brand" href="{{ url('/employees') }}">
                                    Home
                                </a>
                                <a class="navbar-brand" href="{{ url('/employees/create') }}">
                                    create
                                </a>
                            <form class="navbar-form navbar-left"  action="{{ url('/employees/search') }} ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Search">
                                        </div>
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </form>
                            </div>
            
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="nav navbar-nav">
                                    &nbsp;
                                </ul>
            
                                <!-- Right Side Of Navbar -->
                                <ul class="nav navbar-nav navbar-right">
                                    <!-- Authentication Links -->
                                    @guest
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                                    @else
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>
            
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>
            
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
            
                   
                </div>
        <div class="container">
            <h2>click a place to get the address</h2>
        <div id="map">

        </div>
        </div>
    </body>
</html>