<?php
function reloadPage($link)
{
    $link = str_replace("&amp;", "&", $link);

    header("HTTP/1.0 301 Moved Permanently");
    header("location: " . $link);
    header("Connection: close");
    exit();
}