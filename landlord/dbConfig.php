<?php

function dbCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "12345678";
    $dbname = "nspacedb";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}
function conClose($conn)
{
    $conn->close();
}
?>
