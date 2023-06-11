<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}: 403</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/403.css') }}">
</head>

<body>
    <div id="message" class="message">You are not authorized.</div>
    <div id="message2" class="message2">You tried to access a page you did not have prior authorization for.</div>
    <div class="container">
        <div class="neon">403</div>
        <div class="door-frame">
            <div class="door">
                <div class="rectangle">
                </div>
                <div class="handle">
                </div>
                <div class="window">
                    <div class="eye">
                    </div>
                    <div class="eye eye2">
                    </div>
                    <div class="leaf">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.addEventListener('contextmenu', event => event.preventDefault());
        // document.getElementById('message').onselectstart = function() { return false; }
        // document.getElementById('message2').onselectstart = function() { return false; }
    </script>
</body>

</html>
