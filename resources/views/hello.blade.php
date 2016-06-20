<?php
    //$username = Session::get('username');
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
                        <?php //echo '<h1> Hello, '.$user_name.'</h1>' ?> 
                        <a href="/follower">Follower Alert</a> |
                        <a href="/list">Follower List</a> |
                        <a href="/supporters">Support List</a>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection