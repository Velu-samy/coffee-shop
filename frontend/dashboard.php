<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #table-light-brown th {
            background-color: #D2B48C;
            color: black;
        }

        .table-bordered {
            border: 2px solid #000;
        }

        .grid-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .grid-item {
            background-color: #f4a460;
            color: black;
            padding: 20px;
            text-align: center;
            border: 2px solid #000;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <h2> </h2>
        <ul class="nav flex-column mt-5 pt-5">
            <li class="nav-item mt-4 mt-4 p-2">
                <a class="nav-link-active" href="#">Dashboard</a>
            </li>
            <li class="nav-item mt-4 p-2">
                <a class="nav-link-active" href="#">Bookings</a>
            </li>
            <li class="nav-item mt-4 p-2">
                <a class="nav-link-active" href="#">Products</a>
            </li>
            <li class="nav-item mt-4 p-2">
                <a class="nav-link-active" href="#">Customers</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container col-9">
            <div class="container-bookings mt-5">
                <table class="table table-bordered" id="table-light-brown">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Members</th>
                            <th>Date of Booking and Time</th>
                            <th>Coffee Name</th>
                            <th>Code</th>
                            <th>Phonenumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection details
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "test";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to fetch data
                        $sql = "SELECT firstname, lastname, members, datentime, coffeename, code, phonenumber FROM bookingdetails";
                        $result = $conn->query($sql);

                        // Initialize row counter
                        $rowNumber = 1;

                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $rowNumber . "</td>"; // Increment row number
                                echo "<td>" . $row["firstname"] . "</td>";
                                echo "<td>" . $row["lastname"] . "</td>";
                                echo "<td>" . $row["members"] . "</td>";
                                echo "<td>" . $row["datentime"] . "</td>";
                                echo "<td>" . $row["coffeename"] . "</td>";
                                echo "<td>" . $row["code"] . "</td>";
                                echo "<td>" . $row["phonenumber"] . "</td>";
                                echo "</tr>";
                                $rowNumber++; // Increment counter
                            }
                        } else {
                            echo "<tr><td colspan='8'>No results found</td></tr>";
                        }

                        // SQL query to count today's bookings
                        $todayDate = date("Y-m-d");
                        $countTodaySql = "SELECT COUNT(*) as totalToday FROM bookingdetails WHERE DATE(datentime) = '$todayDate'";
                        $countTodayResult = $conn->query($countTodaySql);
                        $todayRow = $countTodayResult->fetch_assoc();
                        $todayBookings = $todayRow["totalToday"];

                        // SQL query to count all bookings
                        $countTotalSql = "SELECT COUNT(*) as totalBookings FROM bookingdetails";
                        $countTotalResult = $conn->query($countTotalSql);
                        $totalRow = $countTotalResult->fetch_assoc();
                        $totalBookings = $totalRow["totalBookings"];

                        // Close connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
                <div class="grid-box">
                    <div class="grid-item">
                        <h2>Bookings Made Today</h2>
                        <p><?php echo $todayBookings; ?></p>
                    </div>
                    <div class="grid-item">
                        <h2>Total Bookings</h2>
                        <p><?php echo $totalBookings; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="kit">
            <h1></h1>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"></script>

</body>

</html>
