<?php
session_start();

// Include the database configuration
include_once '../config/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare a select statement to retrieve user information
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_username);

        // Set parameters
        $param_username = $username;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();

            // Check if the username exists, if yes, verify password
            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($id, $username, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        // Redirect user to welcome page
                        header("location: ../pages/home.php");
                    } else {
                        // Display an error message if password is not valid
                        echo "Invalid username or password.";
                    }
                }
            } else {
                // Display an error message if username doesn't exist
                echo "Invalid username or password.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>
