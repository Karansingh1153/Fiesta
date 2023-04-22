<?php
session_start();

include('../include/db_conn.php');
include('../include/head.php');
include('../include/loading.php');


if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['member']) && isset($_POST['description'])) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes(($data));
            $data = htmlspecialchars($data);
            return $data;
        }
    }

    $eventId = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $eventName = validate($_POST['name']);
    $eventMember = validate($_POST['member']);
    $eventFaculty = validate($_POST['faculty']);
    $eventDescription = validate($_POST['description']);

    $tableName = $_SESSION['festName'];

    $sql = "INSERT INTO `$tableName` (`eventId`, `eventName`, `eventDescription`, `eventFaculty`, `eventMembers`) VALUES ('" . $eventId . "','" . $eventName . "', '" . $eventDescription . "', '" . $eventFaculty . "', '" . $eventMember . "')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: organizer.php');
    } else {
        header('Location:organizer.php?error=Something went wrong');
    }
}

if (isset($_SESSION['festName'])) {
?>
    <div class="load">
        <div class="row mx-auto festEvents" id="festEvents">
            <h1 class="text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="500">Add Event</h1>
            <div class="col-md-10 mx-auto">
                <div class="row mx-auto festEvents-col-reverse my-5">
                    <div class="col-12 col-md-12 col-lg-6 festEvents-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <form action="festEvent.php" method="post">
                            <div class="py-4 px-5">
                                <?php
                                if (isset($_GET['error'])) {
                                ?>
                                    <div class="error-space">
                                        <p class="error text-center"><?php echo $_GET['error']; ?></p>
                                    </div>
                                <?php } ?>
                                <input type="text" name="name" id="name" class="w-100 my-2" required placeholder="Event Name">
                                <input type="text" name="member" id="member" class="w-100 my-2" required placeholder="Event Members">
                                <input type="text" name="faculty" id="faculty" class="w-100 my-2" required placeholder="Event Faculty">
                                <div class="d-flex my-3 flex-column">
                                    <textarea name="description" id="description" cols="10" rows="4" placeholder="Event Description"></textarea>
                                </div>
                                <div class="mx-auto d-flex justify-content-center">
                                    <button class="btn my-2" name="submit" type="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-enter align-items-center" data-aos="zoom-in-up" data-aos-duration="1000">
                        <img src="../assets/img/event.png" class="d-block w-100" alt="Event Image">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
include('../include/footer.php');
include('../include/scripts.php');
?>