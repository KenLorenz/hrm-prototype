<?php

define('ROOT_URL','http://localhost/prototype/');
define('DB_HOST', 'localhost');
define('DB_USER', 'ren');
define('DB_PASS', '122846');
define('DB_NAME', 'hrm_functional');
define('DB_PORT', '3306');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if(mysqli_connect_errno()){
    echo 'Failed to connect to MySQL'.mysqli_connect_errno();
}
