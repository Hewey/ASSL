<?php
    
    $username = Session::get('username');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alert Me</title>

    </head>
    <body>
        <section>
            <h1>Register</h1>
            <?php echo '<p>Hello '.$username.'! It looks like you do not have an account with Alert Me! To sign up with us please enter a password in the form below!'?>
            <form method="POST" action="/register">
                <?php echo '<label>Username: '.$username.'</label>' ?><br>
                <label>Password: </label><input type="text" name="password"><br>
                <input type="hidden" name="username" value="{{ $username }}"> 
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="submit" value="Sign Up">
            </form>
        </section>

    </body>
</html>