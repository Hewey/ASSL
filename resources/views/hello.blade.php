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
        'redirect_uri'=>'http://localhost:8000/Tlogin',
        'code'=>$code 
    );

    $info = post_url_contents("https://api.twitch.tv/kraken/oauth2/token", $auth_param);

    $info_de = json_decode($info, true);

    $token = $info_de['access_token'];

    if(is_null($token)) {
        //do nothing
    }else{

        $results = get_url_contents("https://api.twitch.tv/kraken?oauth_token=".$token);

        $resultsDe = json_decode($results);

        $username = $resultsDe->token->user_name;

    }
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <section class="container">
                    <article>
                        <h1>Hello, {{$username}}</h1>
                        <?php //echo '<h1> Hello, '.$user_name.'</h1>' ?> 
                        <form action="/follower" method="post">
                            <input type="hidden" name="username" value='{{$username}}'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="submit" class="btn btn-info" value="Follower Alert">
                        </form>
                        <br>
                        <form action="/list" method="post">
                            <input type="hidden" name="username" value='{{$username}}'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="submit" class="btn btn-info" value="Follower List">
                        </form>
                        <br>
                        <a href="/supporters" class="btn btn-info">Support List</a>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection