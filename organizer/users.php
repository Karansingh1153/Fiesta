<?php
$id = $_SESSION['id'];
$query = "SELECT f.festName, r.*, v.* FROM fests f LEFT JOIN registrations r ON f.userId = r.userId LEFT JOIN volunteers v ON f.userId = v.userId WHERE f.userId = '$id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $festName = $row['festName'];
        echo "<h1 align='center'>$festName</h1>";
        echo "<h2 align='center'>Registrations</h2>";
        echo "<table class='table table-striped table-hover'>
                <thead class='text-center'>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Phone</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        while ($regRow = mysqli_fetch_assoc($result)) {
            if ($regRow['id']) {
                echo $id;
                echo "<tr>";
                echo "<td>" . $regRow['id'] . "</td>";
                echo "<td>" . $regRow['userId'] ."</td>";
                echo "<td>" . $regRow['eventId'] . "</td>";
                echo "<td>" . $regRow['eventName'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</tbody></table>";

        mysqli_data_seek($result, 0); // reset the pointer to the beginning of the result set

        echo "<h2 align='center'>Volunteers</h2>";
        echo "<table class='table table-striped table-hover'>
                <thead class='text-center'>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Phone</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        while ($volRow = mysqli_fetch_assoc($result)) {
            if ($volRow['volunteerId']) {
                echo "<tr>";
                echo "<td>" . $volRow['id'] . "</td>";
                echo "<td>" . $volRow['userId'] ."</td>";
                echo "<td>" . $volRow['eventId'] . "</td>";
                echo "<td>" . $volRow['volunteerId'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</tbody></table>";
    }
} else {
    header('Location: selectService.php');
}

