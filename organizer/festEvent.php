<?php
session_start();

include('../include/db_conn.php');

if (isset($_POST['name']) && isset($_POST['member']) && isset($_POST['description'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$eventName = validate($_POST['name']);
$eventMember = validate($_POST['member']);
$eventDescription = validate($_POST['description']);

$tableName = $_SESSION['festname'];

$sql = "INSERT INTO `$tableName` (`eventname`, `eventdesc`, `eventmem`) VALUES ('" . $eventName . "', '" . $eventDescription . "', '" . $eventMember . "')";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('Location: organizer.php');
} else {
    header('Location:organizer.php?error=Something went wrong');
}

if (isset($_SESSION['fest']) || isset($_GET['fest'])) {
?>
    <div class="row mx-auto festEvents" id="festEvents">
        <h1 class="text-center my-2" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="500">Add Event</h1>
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
                            <div class="d-flex my-3 flex-column">
                                <textarea name="description" id="description" cols="10" rows="4" placeholder="Event Description"></textarea>
                            </div>
                            <div class="mx-auto d-flex justify-content-center">
                                <button class="btn my-2" type="submit">Add</button>
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
<?php
}
