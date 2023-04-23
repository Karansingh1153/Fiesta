<?php
$id = $_SESSION['id'];
$query = "SELECT * FROM `fests` WHERE `userId` = '$id'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $festName = $row['festName'];
        echo "<h1 align='center'>$festName</h1>";
        if ($festName) {
            // Display registrations table data
            $query = "SELECT * FROM `registrations` WHERE `festName` = '$festName'";
            $regResult = mysqli_query($conn, $query);
            if (mysqli_num_rows($regResult) > 0) {
                echo "<h2 align='center'>Registrations</h2>";
                echo "<table class='table table-striped table-hover'>";
                echo "<thead class='text-center'>";
                echo "<tr>";
                echo "<th scope='col'>ID</th>";
                echo "<th scope='col'>UserId</th>";
                echo "<th scope='col'>EventId</th>";
                echo "<th scope='col'>FestName</th>";
                echo "<th scope='col'>EventName</th>";
                echo "<th scope='col'>Name</th>";
                echo "<th scope='col'>Enrollment</th>";
                echo "<th scope='col'>Mobile</th>";
                echo "<th scope='col'>DOB</th>";
                echo "<th scope='col'>Department</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='text-center'>";
                while ($regRow = mysqli_fetch_assoc($regResult)) {
                    echo "<tr>";
                    echo "<td>" . $regRow['id'] . "</td>";
                    echo "<td>" . $regRow['userId'] . "</td>";
                    echo "<td>" . $regRow['eventId'] . "</td>";
                    echo "<td>" . $regRow['festName'] . "</td>";
                    echo "<td>" . $regRow['eventName'] . "</td>";
                    echo "<td>" . $regRow['name'] . "</td>";
                    echo "<td>" . $regRow['enrollment'] . "</td>";
                    echo "<td>" . $regRow['mobile'] . "</td>";
                    echo "<td>" . $regRow['dob'] . "</td>";
                    echo "<td>" . $regRow['department'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No registrations found for $festName</p>";
            }
            $query = "SELECT * FROM `volunteers` WHERE `festName` = '$festName'";
            $regResult = mysqli_query($conn, $query);
            if (mysqli_num_rows($regResult) > 0) {
                echo "<h2 align='center'>Volunteer</h2>";
                echo "<table class='table table-striped table-hover'>";
                echo "<thead class='text-center'>";
                echo "<tr>";
                echo "<th scope='col'>ID</th>";
                echo "<th scope='col'>UserId</th>";
                echo "<th scope='col'>EventId</th>";
                echo "<th scope='col'>VolunteerId</th>";
                echo "<th scope='col'>FestName</th>";
                echo "<th scope='col'>EventName</th>";
                echo "<th scope='col'>Name</th>";
                echo "<th scope='col'>Enrollment</th>";
                echo "<th scope='col'>Mobile</th>";
                echo "<th scope='col'>DOB</th>";
                echo "<th scope='col'>Department</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='text-center'>";
                while ($regRow = mysqli_fetch_assoc($regResult)) {
                    echo "<tr>";
                    echo "<td>" . $regRow['id'] . "</td>";
                    echo "<td>" . $regRow['userId'] . "</td>";
                    echo "<td>" . $regRow['eventId'] . "</td>";
                    echo "<td>" . $regRow['volunteerId'] . "</td>";
                    echo "<td>" . $regRow['festName'] . "</td>";
                    echo "<td>" . $regRow['eventName'] . "</td>";
                    echo "<td>" . $regRow['name'] . "</td>";
                    echo "<td>" . $regRow['enrollment'] . "</td>";
                    echo "<td>" . $regRow['mobile'] . "</td>";
                    echo "<td>" . $regRow['dob'] . "</td>";
                    echo "<td>" . $regRow['department'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No registrations found for $festName</p>";
            }
        }
    }
}
