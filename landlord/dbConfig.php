<?php
<<<<<<< HEAD
function OpenCon()
{
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "avi";
$dbname = "nspacedb";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Connect failed: %s\n". $conn -> error);
return $conn;
}
function CloseCon($conn)
{
$conn -> close();
}
=======
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
>>>>>>> 8ba45b023ef5bb434ddea77e7baeafddf7c707d2
