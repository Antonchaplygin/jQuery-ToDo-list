<?php

//---------------------------------------------------------
define('DEBUG_MODE', false);
//---------------------------------------------------------

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123');
define('DB_NAME', '2021');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
//---------------------------------------------------------

define('URL', '/Mvc-tasks');
//---------------------------------------------------------

define('MAXIMUM_LOGINS', 3);

//---------------------------------------------------------

define('SITENAME', 'Tasks');

//---------------------------------------------------------
