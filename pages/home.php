<?php
session_start();

// Check if user is not logged in, redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include the database configuration
include_once '../config/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- <?php include_once '../includes/header.php'; ?> -->
    <?php

    // Sorting parameters
    $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'student_id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    // Search parameter
    $searchName = isset($_GET['search']) ? $_GET['search'] : '';

    // Retrieve Data with Sorting and Search
    $sql = "SELECT student_name, student_id, mobile_number FROM students WHERE student_name LIKE '%$searchName%' ORDER BY $orderBy $order";
    $result = $conn->query($sql);
    ?>
    <div class="nav">
        <!-- <a href="#" onclick="verify_pin()">Admin</a> -->
        <a href="../pages/admin.html">Admin</a>
    </div>

    <div class="container">
        <h1>Student Data</h1>

        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" class="search-input" placeholder="Search by name" value="<?php echo $searchName; ?>">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>

        <table>
            <tr>
                <th><a href="?orderby=student_id&order=<?php echo $order === 'ASC' ? 'DESC' : 'ASC'; ?>">Std_id</a></th>
                <th><a href="?orderby=student_name&order=<?php echo $order === 'ASC' ? 'DESC' : 'ASC'; ?>">Name</a></th>
                <th>Month</th>
                <th>Action</th>
            </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["student_id"] . "</td>";
                echo "<td>" . $row["student_name"] . "</td>";
                echo "<td>";
                echo "<select class='month-dropdown'>";
                
                // Add months to the dropdown
                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                foreach ($months as $month) {
                    echo "<option value='$month'>$month</option>";
                }

                echo "</select>";
                echo "</td>";
                echo "<td><button class='btn' onclick='displayAlert(this, \"" . $row["student_name"] . "\", \"" . $row["mobile_number"] . "\")'>Send</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>0 results</td></tr>";
        }
        ?>
        </table>
    </div>

<script>
    // function verify_pin(){
    //     const pin = prompt("Enter PIN : ");
    //     if(pin === "2003"){
    //         window.location.href = "admin.html";
    //     }else{
    //         alert("Incorrect PIN")
    //     }

    // }
    var date = new Date();
    var dateString = `${date.getDate()}.${date.getMonth()}.${date.getSeconds()}`;
    dateString = dateString.toString();
    var time = `${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
    time = time.toString();

    function displayAlert(btn, studentName, mobileNumber) {
        var selectedMonth = btn.parentNode.previousElementSibling.querySelector(".month-dropdown").value;
        var link = `https://wa.me/+91${mobileNumber}?text=*SKS Silambam*%0a%0a${studentName} "${selectedMonth}" மாதத்திற்கான "ரூ.300" ஐ செலுத்தியுள்ளார் %0a%0a${studentName} has paid "Rs.300" for "${selectedMonth}" %0a%0aon %0aDate : ${dateString} %0aTime : ${time}`;
        window.open(link);
    }
</script>

</body>
</html>

<?php
// Close Connection
$conn->close();
?>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
