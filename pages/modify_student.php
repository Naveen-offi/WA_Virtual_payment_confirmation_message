<?php

// Include the Middleware
include_once '../middleware/middleware.php';

// Include the database configuration
include_once '../config/config.php';

// Function to modify student details
function modifyStudent($id, $name, $mobile) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $mobile = mysqli_real_escape_string($conn, $mobile);

    $sql = "UPDATE students SET student_name='$name', mobile_number='$mobile' WHERE student_id='$id'";

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
    <title>Modify Student Details</title>
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
            if (isset($_POST["modify"])) {
                $modifyId = $_POST["modify_id"];
                $modifyName = $_POST["modify_name"];
                $modifyMobile = $_POST["modify_mobile"];

                if (modifyStudent($modifyId, $modifyName, $modifyMobile)) {
                    echo "Student details modified successfully.";
                } else {
                    echo "Error modifying student details.";
                }
            }
        }
    ?>
    </div>
    <form method="post" action="">
        <h1>Modify Student Details</h1>

        <!-- Modify Student Details -->
        <label>Student ID:</label><br>
        <input type="text" name="modify_id" placeholder="Student ID" required><br>

        <label>New Name:</label><br>
        <input type="text" name="modify_name" placeholder="New Name" required><br>

        <label>New Mobile Number:</label><br>
        <input type="text" name="modify_mobile" placeholder="New Mobile Number" required><br>

        <button type="submit" name="modify">Modify</button>
    </form>

    </body>
</html>

<?php
// Close Connection
$conn->close();
?>
