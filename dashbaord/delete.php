<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password
$dbname = "test";    // Your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "Delete  FROM detail WHERE name=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        echo "<script>
        alert('Action completed successfully!');
        window.location.href = 'display.php';
    </script>";
    }
    else{
        echo "<script>
        alert( 'error occured');
        window.location.href = 'display.php';
    </script>";
    }

}


?>