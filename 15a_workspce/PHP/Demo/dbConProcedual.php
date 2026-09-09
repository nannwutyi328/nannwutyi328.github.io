<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "root",
    "student_db"
);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";?>
