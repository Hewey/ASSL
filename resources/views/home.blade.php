@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Log in through twitch</p>
                    <a href="https://api.twitch.tv/kraken/oauth2/authorize?response_type=code&client_id=3r9kwgbszo5avv7uyrahv8upx5h90gp&redirect_uri=http://localhost:8000/Tlogin&scope=user_read">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
