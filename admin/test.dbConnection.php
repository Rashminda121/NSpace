<?php
include 'dbConfig.php';
$conn = OpenCon();
echo "Connected Successfully";
CloseCon($conn);
?>