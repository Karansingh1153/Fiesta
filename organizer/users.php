<?php
$id = $_SESSION['id'];
$query = "SELECT * FROM `fests` WHERE `userId` = '$id'";
$result = mysqli_query($conn, $query);
echo "<h1 class='text-center mt-5 my-2'>Participants</h1>";
echo "<center><hr class='w-50'/></center>";
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $festName = $row['festName'];
        if ($festName) {
            // Display registrations table data
            $query = "SELECT * FROM `registrations` WHERE `festName` = '$festName'";
            $regResult = mysqli_query($conn, $query);
            if (mysqli_num_rows($regResult) > 0) {
                echo "<h3 align='center'>" . $festName . " Registrations</h3>";
                echo "<table class='table table-striped table-hover w-100 my-5'>";
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
                echo "<center><p>No registrations found for $festName</p></center>";
            }
            $query = "SELECT * FROM `volunteers` WHERE `festName` = '$festName'";
            $regResult = mysqli_query($conn, $query);
            if (mysqli_num_rows($regResult) > 0) {
                echo "<h3 align='center'>" . $festName . " Volunteer</h3>";
                echo "<table class='table table-striped table-hover w-100 my-5'>";
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
                echo "<center><p>No Volunteers found for $festName</p></center>";
            }
        }
    }
}
