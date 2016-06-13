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
            <h1>Login</h1>
            <?php echo '<p>Hello '.$username.'! Please log in to continue!'?>
            <form method="POST" action="/letmein">
                <?php echo '<label>Username: '.$username.'</label>' ?><br>
                <label>Password: </label><input type="text" name="password"><br>
                <input type="hidden" name="username" value="{{ $username }}"> 
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="submit" value="Login">
            </form>
        </section>

    </body>
</html>