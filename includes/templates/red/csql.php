<?php
//DB details
$sqlinfo = parse_ini_file("/secret/sql.ini");
$dbHost = $sqlinfo['host'];
$dbUsername = $sqlinfo['username'];
$dbPassword = $sqlinfo['password'];
$dbName = $sqlinfo['database'];

//Create connection and select DB
$dbc = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($dbc->connect_error) {
    die("Unable to connect database: " . $dbc->connect_error);
}
