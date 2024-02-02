<?php

// Include the Middleware
include_once '../middleware/middleware.php';

// Include the database configuration
include_once '../config/config.php';

// Function to remove a student
function removeStudent($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM students WHERE student_id = '$id'";

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
    <title>Remove Student</title>
    <link rel="stylesheet" href="../css/student.css">

</head>
<body>
    <div class="nav"><a href="admin.html">⇐ back</a><br /></div>
    <div class="msg">
        <?php
        // Handle form submission

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["remove"])) {
                $removeId = $_POST["remove_id"];

                if (removeStudent($removeId)) {
                    echo "Student removed successfully.";
                } else {
                    echo "Error removing student.";
                }
            }
        }
    ?>
    </div>
    <form method="post" action="">
        <h1>Remove Student</h1>

        <!-- Remove Student -->
        <label>Student ID:</label><br>
        <input type="text" name="remove_id" placeholder="Student ID" required><br>

        <button type="submit" name="remove">Remove</button>
    </form>

    </body>
</html>

<?php
// Close Connection
$conn->close();
?>
