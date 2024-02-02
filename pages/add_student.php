<?php

// Include the Middleware
include_once '../middleware/middleware.php';

// Include the database configuration
include_once '../config/config.php';


// Function to add a new student
function addStudent($name, $mobile) {
    global $conn;
    $name = mysqli_real_escape_string($conn, $name);
    $mobile = mysqli_real_escape_string($conn, $mobile);

    $sql = "INSERT INTO students (student_name, mobile_number) VALUES ('$name', '$mobile')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="../css/student.css">
    <style>
        
    </style>
</head>
<body>
<div class="nav"><a href="admin.html">⇐ back</a><br /></div>
<div class="msg">
    <?php
    // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["add"])) {
                $newName = $_POST["new_name"];
                $newMobile = $_POST["new_mobile"];

                if (addStudent($newName, $newMobile)) {
                    echo "Student added successfully.";
                } else {
                    echo "Error adding student.";
                }
            }
        }
        ?>
    </div>
<div class="container">
<form method="post" action="">
    
    <h1>Add Student</h1>

    <!-- Add Student -->
    <label>Student Name:</label><br>
    <input type="text" name="new_name" placeholder="Student Name" required><br>

    <label>Mobile Number:</label><br>
    <input type="text" name="new_mobile" placeholder="Mobile Number" required><br>

    <button type="submit" name="add">Add</button>
</form>


</body>
</html>

<?php
// Close Connection
$conn->close();
?>
