<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) .
            '/_php/app'
            ));

// Define path to application directory
defined('LIBRARY_PATH')
    || define('LIBRARY_PATH', realpath(dirname(__FILE__) .
            '/_php/library'
            ));

// Define path to public directory
defined('PUBLIC_PATH')
    || define('PUBLIC_PATH', realpath(dirname(__FILE__) ));

// Ensure library/ and app/ are on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH, 
    APPLICATION_PATH
)));

//lets boot our web application
require 'bootstrap.php';

//echo "Ahoj Honzo, jak se mas? ;)";
?>