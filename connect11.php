<?php
// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "webform1";
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    // Check if name already exists (database)
    $sql = "SELECT * FROM web1 WHERE firstname='$firstname' AND lastname='$lastname'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "ERROR: Name already existed! ";
    } else {
        // Add name (database)
        $sql = "INSERT INTO web1 (firstname, lastname) VALUES ('$firstname', '$lastname')";
        if (mysqli_query($conn, $sql)) {
            echo "Name submitted to database successfully! ";
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>