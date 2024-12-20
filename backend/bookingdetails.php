<?php

$con = mysqli_connect("localhost", "root", "", "test");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$_firstname = $_POST['fn'];
$_lastname = $_POST['ln'];
$_mem = $_POST['mb'];
$_dateandtime = $_POST['dt'];
$_coffeename = $_POST['cn'];
$_tele = $_POST['phonenumber'];

// Generate a random 4-digit code
$_coded = rand(1000, 9999); // Ensures a 4-digit number

// SQL query to insert data
$sql = "INSERT INTO bookingdetails (firstname, lastname, members, datentime, coffeename, code,phonenumber) 
        VALUES ('$_firstname', '$_lastname', '$_mem', '$_dateandtime', '$_coffeename', '$_coded', '$_tele')";

$result = mysqli_query($con, $sql);

if ($result) {
    header("Location:../frontend/thankyou.php?code=$_coded");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>
