<?php

$bcolor = 'grey';
$tcolor = 'white';

$user = Auth::user();

$userid = $user->id;

$result = DB::select('select * from ListSettings where userid = ?', [$userid]);


foreach ($result as $setting) {
    $bcolor = '#'.$setting->bcolor;
    $tcolor = '#'.$setting->tcolor;
}
$username = Session::get('username');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/modal.css" rel="stylesheet" type="text/css">

        <style>
            <?php
            header("Content-type: text/css; charset: UTF-8");
            ?>
            body {
                background-color: rgba(0,0,0,0);
                font-weight: 100;
                font-family: 'Lato';
            }
            .first {
                color: <?php echo $tcolor; ?>;
                position: absolute;
                left: -150px;
                width: auto;
                height: 25px;
                text-align: center; 
                background-color: <?php echo $bcolor; ?>;
                -webkit-animation: slide 0.5s forwards;
                -webkit-animation-delay: 2s;
                animation: slide 0.5s forwards;
                animation-delay: 2s;
            }
            .static {
                color: <?php echo $tcolor; ?>;
                position: absolute;
                width: auto;
                height: 25px;
                margin-left: -8px;
                text-align: center; 
                background-color: <?php echo $bcolor; ?>;
            }
            .second {
                color: rgba(0,0,0,0.75);
            }
            .third {
                color: rgba(0,0,0,0.50);
            }
            .last {
                color: rgba(0,0,0,0.25);
            }
            @-webkit-keyframes slide {
                100% { left: 0; }
            }

            @keyframes slide {
                100% { left: 0; }
            }
        </style>
    </head>
    <body>
        <div id="f1" class="hidden"></div>
        <div id="f2" class="hidden"></div>
        <div id="f3" class="hidden"></div>
        <div id="f4" class="hidden"></div>

        <a id="open" href="#openModal">Edit</a>

        <div id="openModal" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2>Edit Your Follower List!</h2>
                <form action="/listsettings" method="post">
                    <label>Text Color:</label><input type="text" name="tcolor"><span id="atn">*</span><br>
                    <label>Background Color:</label><input type="text" name="bcolor"><span id="atn">*</span><br>
                    <input type="hidden" name="username" value='{{$username}}'>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <p id="atn">*: Please enter a Hex value for the color!</p>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
        <script type="text/javascript">
            Twitch.init({clientId: '3r9kwgbszo5avv7uyrahv8upx5h90gp'}, function(error, status) {
                // the sdk is now loaded
            });
            var current = "";
            setInterval(function(){
                Twitch.api({method: 'channels/{{$username}}/follows?limit=4'}, function(error, status) {
                    if (error) {
                        console.log(error)
                    } else {
                        var list = status;
                        var n1 = status.follows[0].user.name;
                        var n2 = status.follows[1].user.name;
                        var n3 = status.follows[2].user.name;
                        var n4 = status.follows[3].user.name;
                        if (n1 !== current){
                            current = n1;
                            document.getElementById('f1').innerHTML=n4;
                            document.getElementById('f1').className="last";
                            document.getElementById('f2').innerHTML=n3;
                            document.getElementById('f2').className="third";
                            document.getElementById('f3').innerHTML=n2;
                            document.getElementById('f3').className="second";
                            document.getElementById('f4').innerHTML=n1;
                            document.getElementById('f4').className="first";
                            setTimeout(function(){document.getElementById('f4').className="static";},5000); 
                        }
                    };
                });
            }, 5000);

        </script>
    </body>
</html>
