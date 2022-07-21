<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/95b5988cdb.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .sidenav-left {
            width: 20%;
            position: fixed;
            z-index: 1;
            top: 12%;
            left: 2%;
            overflow-x: hidden;
            padding-top: 0;
        }

        .sidenav-right {
            width: 20%;
            position: fixed;
            z-index: 1;
            top: 12%;
            left: 77%;
            overflow-x: hidden;
            padding-top: 0;
        }
        
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: ##818181;
            display: block;
        }

        .sidenav a:hover {
            color: #064579;
        }

        .title {
            font-family: "Cairo";
            text-align: center;
            color: #FFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 30vh;
            letter-spacing: 1px;
            line-height:2
        }

        .texto-bienvenida {
            background-image: url(https://media.giphy.com/media/26BROrSHlmyzzHf3i/giphy.gif);
            background-size: cover;
            color: transparent;
            -moz-background-clip: text;
            -webkit-background-clip: text;
            text-transform: uppercase;
            font-size: 4vw;
            margin: 10px 0;
        }

        .text-properties{
            text-align:center;
            color: #FFF;
            font-family:'Roboto';
            font-weight:2;
            font-size:2vw;
            padding-top:1vh;
            overflow:hidden;
            -webkit-backface-visibility: hidden;
            -webkit-perspective: 1000;
            -webkit-transform: translate3d(0,0,0);
        }

        #text-slide {
            display:inline-block;
            overflow:hidden;
            white-space:nowrap;
        }

        #text-slide:first-of-type {    /* For increasing performance 
                            ID/Class should've been used. 
                            For a small demo 
                            it's okaish for now */
            animation: showup 7s infinite;
        }

        #text-slide:last-of-type {
            width:0px;
            animation: reveal 7s infinite;
        }

        #text-slide:last-of-type span {
            margin-left:-355px;
            animation: slidein 7s infinite;
        }

        @keyframes showup {
            0% {opacity:0;}
            20% {opacity:1;}
            80% {opacity:1;}
            100% {opacity:0;}
        }

        @keyframes slidein {
            0% { margin-left:-800px; }
            20% { margin-left:-800px; }
            35% { margin-left:0px; }
            100% { margin-left:0px; }
        }

        @keyframes reveal {
            0% {opacity:0;width:0px;}
            20% {opacity:1;width:0px;}
            30% {width:355px;}
            80% {opacity:1;}
            100% {opacity:0;width:355px;}
        }
        
        .profile-head {
            transform: translateY(5rem)
        }

        .cover {
            background-size: cover;
            background-repeat: no-repeat
        }

        .custom-link, .custom-link:visited {
            color: #7B7B7C;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .custom-link:hover, .custom-link:active {
            color: #202A44;
        }

        .custom1-link, .custom1-link:visited {
            color: #7B7B7C;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .custom1-link:hover, .custom1-link:active {
            color: #202A44;
            text-decoration: none;
        }

        .open-button {
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 3.5%;
            right: 3.5%;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 7.5%;
            right: 0.5%;
            border: 3% solid #f1f1f1;
            z-index: 9;
        }

        .searchbar{
            height: 100%;
            background-color: #353b48;
            border-radius: 30px;
        }

        .search_input{
            color: white;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 40px;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_input{
            padding: 0 10px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
        }

        .search_icon{
            height: 100%;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:red;
            text-decoration:none;
        }
    </style>

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--Datatable-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
</head>
<body>
    
        @include('inc.navbar')
        <br>
        <div class="container">
            @include('inc.messages')
            @yield('content')

        </div>

        <button class="btn btn-outline-dark open-button" onclick="openForm()">Chat Bot</button>

        <div class="chat-popup" id="myForm">
            <iframe
                allow="microphone;"
                width="350"
                height="430"
                src="https://console.dialogflow.com/api-client/demo/embedded/96406953-29d3-445c-a394-c01f3050d64f">
            </iframe>
            <button type="button" class="btn-close float-end" aria-label="Close" onclick="closeForm()"></button>
        </div>

        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }
            
            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!--Chart JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!--Datatable-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" defer></script>
    @yield('scripts')
</body>
</html>
