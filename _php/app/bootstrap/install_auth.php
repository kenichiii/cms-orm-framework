<?php

if( isset($_POST['pwd']) &&  isset($_POST['login'])
        && $_POST['login'] == Project::$installAuthLogin
        && $_POST['pwd'] == Project::$installAuthPwd )
{
    $_SESSION['ins_auth'] = true;
    reloadPage($_SERVER['REQUEST_URI']);
    exit;
}
    
$_auth = isset($_SESSION['ins_auth']) && $_SESSION['ins_auth'] ? true : false;

if(!$_auth)
{
    ?>
        <html>
            <h1>Project config</h1>
            <form method="post">                
                Login: <input type="text" name="login">
                Password: <input type="password" name="pwd">
                <input type="submit" value="login">
            </form>    
        </html>    
    <?php
    exit();
}