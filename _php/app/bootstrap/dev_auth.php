<?php


if( isset($_GET['basic_auth']) && $_GET['basic_auth'] == Project::$basicAuthPwd )
    $_SESSION['dev_auth'] = true;
    
$_auth = isset($_SESSION['dev_auth']) && $_SESSION['dev_auth'] ? true : false;

if(!$_auth)
{
    ?>
        <html>
         <h1>heslo: <?php echo Project::$basicAuthPwd; ?></h1>
            <form method="get">
                <input type="password" name="basic_auth">
                <input type="submit" value="login">
            </form>    
        </html>    
    <?php
    exit();
}