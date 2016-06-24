<?php

$bcolor = 'grey';
$tcolor = 'white';

$user = Auth::user();

$userid = $user->id;

$result = DB::select('select * from FollowerSettings where userid = ?', [$userid]);


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

            .hidden {
                display: none;
            }

            .alert {
                color: <?php echo $tcolor; ?>;
                position: absolute;
                left: -150px;
                width: auto;
                height: 50px;
                padding-top: 25px;
                text-align: center; 
                background-color: <?php echo $bcolor; ?>;
                -webkit-animation: slide 0.5s forwards;
                -webkit-animation-delay: 2s;
                animation: slide 0.5s forwards;
                animation-delay: 2s;
            }

            .fade {
                -webkit-animation: opacity 0.5s ease-in-out;
                -webkit-animation-delay: 2s;
                animation: opacity 0.5s ease-in-out;
                animation-delay: 2s;
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
        <a id="open" href="#openModal">Edit</a>

        <div id="openModal" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2>Edit Your Alert!</h2>
                <form action="/followersettings" method="post">
                    <label>Text Color:</label><input type="text" name="tcolor"><span id="atn">*</span><br>
                    <label>Background Color:</label><input type="text" name="bcolor"><span id="atn">*</span><br>
                    <input type="hidden" name="username" value='{{$username}}'>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <p id="atn">*: Please enter a Hex value for the color!</p>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
        <div id="follower" class="hidden"></div>
        <script type="text/javascript">
            Twitch.init({clientId: '3r9kwgbszo5avv7uyrahv8upx5h90gp'}, function(error, status) {
                // the sdk is now loaded
            });
            var newFollower = "";
            var followerSound = new Audio('audio/Space_01.mp3');
            setInterval(function(){
                Twitch.api({method: 'channels/{{$username}}/follows'}, function(error, status) {
                    if (error) {
                        console.log(error)
                    } else {
                        var followsList = status;
                        //var newFollower = "";
                        var newFollow = String(followsList.follows[0].user.name);
                        if (newFollower !== newFollow) {
                            newFollower = newFollow;
                            followerSound.play();
                            document.getElementById('follower').className="alert";
                            document.getElementById('follower').innerHTML=newFollower;
                            //setTimeout(function(){document.getElementById('follower').className="fade";},5000);
                            setTimeout(function(){document.getElementById('follower').className="hidden";},6000);
                            //document.getElementById('follower').className="fade";
                            console.log(newFollower);
                        };
                    };
                });
            }, 5000);

        </script>
    </body>
</html>
