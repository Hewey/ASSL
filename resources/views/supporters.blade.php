<?php

$user = Auth::user();

$userid = $user->id;

$results = DB::select('select * from supporters where userid = ? order by amount DESC', [$userid]);
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Alert Me</div>

                <div class="panel-body">
                    <h1>Donators List</h1>
                    <a id="open_support" href="#openModal">Add Supporter</a>

                    <div id="openModal" class="modalDialog">
                        <div>
                            <a href="#close" title="Close" class="close">X</a>
                            <h2>Add a Supporter</h2>
                            <form action="/supporters" method="post">
                                <label>Supporter Name:</label><input type="text" name="name"><br>
                                <label>Donation Amount:</label><input type="text" name="amount"><br>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <input type="submit" value="Add Supporter">
                            </form>
                        </div>
                    </div>

                    <ol>
                        <?php
                            foreach ($results as $listitem) {
                                $id = $listitem->id;
                                ?>
                                <li>Name: {{$listitem->name}} | Amount: ${{$listitem->amount}}
                                <form method='post' action='/deletesupport'>
                                    <input type='hidden' name='id' value='{{$id}}'>
                                    <input type='hidden' name='userid' value='{{$userid}}'>
                                    <input type='hidden' name='_token' id='csrf-token' value='{{ Session::token() }}' />
                                    <input type='submit' value='delete'>
                                </form>
                                <a id="updateSupport" href="#openModal{{$id}}">Update</a>

                                <div id="openModal{{$id}}" class="modalDialog">
                                    <div>
                                        <a href="#close" title="Close" class="close">X</a>
                                        <h2>Update a Supporter</h2>
                                        <form action="/updatesupport" method="post">
                                            <label>Supporter Name:</label><input type="text" name="name"><br>
                                            <label>Donation Amount:</label><input type="text" name="amount"><br>
                                            <input type='hidden' name='id' value='{{$id}}'>
                                            <input type='hidden' name='userid' value='{{$userid}}'>
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <input type="submit" value="Update Supporter">
                                        </form>
                                    </div>
                                </div>
                                </li>
                                <?php
                                //echo '<li>Name: '. $listitem->name . ' | Amount: $' . $listitem->amount . "<form method='post' action='/deletesupport'><input type='hidden' id='id' value='{$id}'><input type='hidden' id='userid' value='{$userid}'><input type='hidden' name='_token' id='csrf-token' value='" . Session::token() . "' /><input type='submit' value='delete'></form></li>";
                            };
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
