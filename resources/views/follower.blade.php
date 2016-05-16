<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            body {
                background-color: rgba(0,0,0,0);
            }

            .hidden {
                display: none;
            }

            .alert {
                position: absolute;
                left: -100px;
                width: 100px;
                height: 50px;
                padding-top: 25px;
                text-align: center; 
                background-color: grey;
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
        <div id="follower" class="hidden"></div>
        <script type="text/javascript">
            Twitch.init({clientId: '3r9kwgbszo5avv7uyrahv8upx5h90gp'}, function(error, status) {
                // the sdk is now loaded
            });
            var newFollower = "";
            setInterval(function(){
                Twitch.api({method: 'channels/admiralhewey/follows'}, function(error, status) {
                    if (error) {
                        console.log(error)
                    } else {
                        var followsList = status;
                        //var newFollower = "";
                        var newFollow = String(followsList.follows[0].user.name);
                        if (newFollower !== newFollow) {
                            newFollower = newFollow;
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
