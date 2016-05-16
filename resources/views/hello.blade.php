<?php
function get_url_contents($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function post_url_contents($url, $fields) {

    $fields_string = '';

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
    rtrim($fields_string, '&');

    $crl = curl_init();
    $timeout = 5;

    curl_setopt($crl, CURLOPT_URL,$url);
    curl_setopt($crl,CURLOPT_POST, count($fields));
    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

$code = $_GET['code'];

$auth_param = array(
    'client_id'=>'3r9kwgbszo5avv7uyrahv8upx5h90gp',
    'client_secret'=>'nse5izypwupw3avkeok57s9d9lh5ghg',
    'grant_type'=>'authorization_code',
    'redirect_uri'=>'http://localhost:8000/login',
    'code'=>$code 
);

$info = post_url_contents("https://api.twitch.tv/kraken/oauth2/token", $auth_param);

$follows = get_url_contents("https://api.twitch.tv/kraken/channels/admiralhewey/follows");

$followers = json_decode($follows);

$info_de = json_decode($info);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                font-size: 1.5rem;
            }

            .container {
                width: 1000px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <header class="container">
            <h1>Alert <span>Me<span></h1>
            <nav>
                <a href="#">Logout</a>
            </nav>
        </header>
        <section class="container">
            <article>
                <a href="/follower">Follower Alert</a>
            </article>
        </section>
    </body>
</html>
