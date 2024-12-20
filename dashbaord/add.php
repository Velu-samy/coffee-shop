<?php

$n = $_POST['named'];
$p = $_POST['passed'];
$cp = $_POST['confirm_passed'];
$m = $_POST['mailed'];

// Check if password and confirm password match
if ($p === $cp) {
    $con = mysqli_connect("localhost", "root", "", "test");
    
    $sql = "INSERT INTO detail(name, password, mail) VALUES ('$n', '$p', '$m')";

    $r = mysqli_query($con, $sql);

    if ($r) {
        echo "<script>
        alert('Added successfully!');
        window.location.href = 'display.php';
    </script>";
    } 
    else {
        echo "<script>
        alert('not added successfully!');
        window.location.href = 'display.php';
    </script>";
    }

    mysqli_close($con);
} else {
    echo "Passwords do not match.";
}
?>
