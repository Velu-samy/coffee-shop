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

// Initialize variables
$oldname = $password = $mail = "";

// Handle GET request to fetch the user details
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "SELECT  password, mail FROM detail WHERE name=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $oldname);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $name = $row['name'];
        $password = $row['password'];
        $mail = $row['mail'];
    } else {
        echo "Record not found.";
        exit;
    }
}

// Handle POST request to update the user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldname = $_POST['name'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];

    $sql = "UPDATE detail SET  password=?, mail=?,name=? WHERE name=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss",name ,$password, $mail, $oldname);

    if ($stmt->execute()) {
        echo "Record updated successfully!";
        header("Location: display.php"); // Redirect to the main page
        exit;

    } else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h1>Edit User Details</h1>
    <form method="POST" action="edit.php">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?= htmlspecialchars($password) ?>" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Mail</label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($mail) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
