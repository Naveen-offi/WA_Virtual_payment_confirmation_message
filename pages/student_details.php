<?php


// Include the Middleware
include_once '../middleware/middleware.php';

// Include the database configuration
include_once '../config/config.php';

// Check if user is not logged in, redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: home.php");
//     exit;
// }

// Function to get student details by ID
function getStudentDetails($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT * FROM students WHERE student_id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Initialize variables
$studentDetails = null;
$errorMessage = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student_id'];

    // Validate student ID
    if (empty($studentId) || !is_numeric($studentId)) {
        $errorMessage = 'Please enter a valid student ID.';
    } else {
        $studentDetails = getStudentDetails($studentId);

        if ($studentDetails === null) {
            $errorMessage = 'Student not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Student Details</title>
    <link rel="stylesheet" href="../css/student.css">
    <style>
       
    </style>
</head>
<body>
<div class="nav"><a href="admin.html">⇐ back</a><br /></div>
<form method="post" action="">

    <h1>Display Student Details</h1>

    <label>Enter Student ID:</label><br>
    <input type="text" name="student_id" placeholder="Student ID" required><br>

    <button type="submit">Display Details</button>
</form>

<div class="details">
    <?php
    if (!empty($errorMessage)) {
        echo "<p class='error'>$errorMessage</p>";
    } elseif (isset($studentDetails)) {
        echo "<h2>Student Details</h2>";
        echo "<p><strong>Student ID:</strong> " . $studentDetails['student_id'] . "</p>";
        echo "<p><strong>Name:</strong> " . $studentDetails['student_name'] . "</p>";
        echo "<p><strong>Mobile Number:</strong> " . $studentDetails['mobile_number'] . "</p>";
    }
    ?>
</div>

</body>
</html>

<?php
// Close Connection
$conn->close();
?>