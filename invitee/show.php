<?php
include('./include/db_conn.php');
?>

<?php

$query = "SELECT DISTINCT `festName` FROM `fests`";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
?>
    <div class="container" id="events">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $festName = $row['festName'];
            echo "<h1 align='center' class='my-5'>$festName</h1>";
            if ($festName) {
                $query = "SELECT * FROM `$festName`";
                $eventResult = mysqli_query($conn, $query);
                if (mysqli_num_rows($eventResult) > 0) {
                    echo "<div class='row'>";
                    while ($eventRow = mysqli_fetch_assoc($eventResult)) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>" . $eventRow['eventName'] . "</h2>";
                        echo "<h5 class='card-title'>" . $eventRow['eventFaculty'] . "</h5>";
                        echo "<p class='card-text'>" . $eventRow['eventDescription'] . "</p>";
                        echo "<div class='d-flex justify-content-center align-items-center' style='gap:0.5rem'>";
                        echo "<a href='./invitee/register.php?id=" . $eventRow['id'] . "&&fest=" . $festName . "' class='btn px-4'>Register</a>";
                        echo "<a href='./invitee/register-volunteer.php?id=" . $eventRow['id'] . "&&fest=" . $festName . "' class='btn-v px-4'>Volunteer</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "No events found for $festName";
                }
            } else {
                header('Location: index.php?error=Something went wrong.F');
            }
        }
        ?>
    </div>
<?php
} else {
    header('Location: selectService.php');
}
?>