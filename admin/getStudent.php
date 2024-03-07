<?php

require_once("dbConfig.php"); 

function getStudents() {
  $conn = OpenCon(); 

  $sqlQuery = "SELECT studID, sname, sbatch, sgender, semail, spass FROM student";

  $result = $conn->query($sqlQuery); 

  if ($result->num_rows > 0) {
    $students = array(); // Array to store student data
    while ($row = $result->fetch_assoc()) {
      $students[] = $row; // Add each row (student data) to the array
    }
    return $students; // Return the array of students
  } else {
    echo "No students found"; 
    return null;
  }

  CloseCon($conn); 
}


$students = getStudents(); // Call the function to get student data

// Access student data:
if ($students) {
  foreach ($students as $student) {
    echo "ID: " . $student["studID"] . ", Name: " . $student["sname"] . "<br>"; 
  }
}

?>
