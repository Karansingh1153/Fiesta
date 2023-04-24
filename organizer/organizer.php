<?php
session_start();

include('../include/head.php');
include('../include/loading.php');
include('../include/db_conn.php');
include('../include/header.php');
?>

<div class="container my-5 d-flex justify-content-center align-items-center" style="gap:1rem;">
    <a href="generateExcelParticipants.php" class="btn">Excel Participant</a>
    <a href="generateExcelVolunteer.php" class="btn">Excel Volunteer</a>
    <a href="selectService.php" class="btn">Add Fests</a>
</div>
<div class="load">
    <?php
    $id = $_SESSION['id'];
    $query = "SELECT * FROM `fests` WHERE `userId` = '$id'";
    $result = mysqli_query($conn, $query);
    echo "<h1 class='text-center mt-5 my-2'>Events</h1>";
    echo "<center><hr class='w-50'/></center>";
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $festName = $row['festName'];
            echo "<h2 align='center'>$festName</h2>";
            if ($festName) {

                $query = "SELECT * FROM `$festName`";
                $eventResult = mysqli_query($conn, $query);
                if (mysqli_num_rows($eventResult) > 0) {
    ?>
                    <table class="table table-striped table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">eventId</th>
                                <th scope="col">eventName</th>
                                <th scope="col">eventDescription</th>
                                <th scope="col">eventFaculty</th>
                                <th scope="col">eventMembers</th>
                                <?php
                                echo "<th>
                                <form method='POST' style='box-shadow: none;' action='festEvent.php?festName=" . $festName . "'>
                                <button type='submit' class='btn' name='add-event'>Add Event</button>
                                </form>
                                </th>";
                                echo "<th>
                                <form method='POST' style='box-shadow: none;' onsubmit='return confirmDelete();' action='deleteFest.php?festName=" . $festName . "'>
                                <button type='submit' class='btn-v' name='add-event'>Delete Fest</button>
                                </form>
                                </th>";
                                ?>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($eventRow = mysqli_fetch_assoc($eventResult)) {
                                echo "<tr>";
                                echo "<td>" . $eventRow['id'] . "</td>";
                                echo "<td>" . $eventRow['eventId'] . "</td>";
                                echo "<td>" . $eventRow['eventName'] . "</td>";
                                echo "<td>" . $eventRow['eventDescription'] . "</td>";
                                echo "<td>" . $eventRow['eventFaculty'] . "</td>";
                                echo "<td>" . $eventRow['eventMembers'] . "</td>";
                                echo "<td>
                                <form method='POST' style='box-shadow: none;' action='updateFestEvent.php?id=" . $eventRow['id'] . "&&festName=" . $festName . "'>
                                <button type='submit' style='background-color:#3ae374; border:2px solid ##3ae374; color:#fff;'  class='btn' name='update'>Update</button>
                                </form>
                            </td>";
                                echo "<td>
                                    <form method='POST' style='box-shadow: none;' onsubmit='return confirmDelete();' action='deleteFestEvent.php?id=" . $eventRow['id'] . "&&festName=" . $festName . "'>
                                    <button type='submit' class='btn-v' style='background-color:#ff3838; border:2px solid #ff3838; color:#fff;' name='delete'>Delete</button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
    <?php
                } else {
                    echo "<center>No events found for .$festName.</center>";
                }
            } else {
                header('Location: organizer.php?error=Something went wrong.F');
            }
        }
    } else {
        header('Location: selectService.php');
    }
    ?>
    <?php
    include('users.php');
    include('../include/footer.php');
    ?>
</div>
<?php
include('../include/scripts.php');
