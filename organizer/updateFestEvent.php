<?php
session_start();

include('../include/head.php');
// include('../include/loading.php');
include('../include/db_conn.php');

$id = $_GET['id'];
$festName = $_GET['festName']; // retrieve festName from URL parameter

if (isset($_POST['update'])) {
    $query = "SELECT * FROM `$festName` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $eventId = $row['eventId'];
        $eventName = $row['eventName'];
        $eventDescription = $row['eventDescription'];
        $eventFaculty = $row['eventFaculty'];
        $eventMembers = $row['eventMembers'];
    }
}

if (isset($_POST['updateEvent'])) {
    $id = $_GET['id'];
    $eventId = $_POST['eventId'];
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventFaculty = $_POST['eventFaculty'];
    $eventMembers = $_POST['eventMembers'];

    $query = "UPDATE `$festName` SET `eventId`='$eventId', `eventName`='$eventName', `eventDescription`='$eventDescription', `eventFaculty`='$eventFaculty', `eventMembers`='$eventMembers' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: organizer.php");
        exit();
    } else {
        echo "Error updating event: " . mysqli_error($conn);
    }
}
?>

<div class="load">
    <?php include('../include/header.php'); ?>
    <div class="row mx-auto festEvents" id="festEvents">
        <h1 class="text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="500">Update Event</h1>
        <div class="col-md-10 mx-auto">
            <form action="" method="POST">
                <div class="row mx-auto festEvents-col-reverse my-5">
                    <div class="col-12 col-md-12 col-lg-6 festEvents-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="py-4 px-5">
                            <input type="text" class="w-100 my-2" id="eventId" name="eventId" value="<?php echo $eventId; ?>" readonly>
                            <input type="text" class="w-100 my-2" id="eventName" name="eventName" value="<?php echo $eventName; ?>" required>
                            <input type="text" class="w-100 my-2" id="eventFaculty" name="eventFaculty" value="<?php echo $eventFaculty; ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 festEvents-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="py-4 px-5">
                            <input type="text" class="w-100 my-2" id="eventMembers" name="eventMembers" value="<?php echo $eventMembers; ?>" required>
                            <textarea class="w-100 my-2" id="eventDescription" name="eventDescription" rows="3" required><?php echo $eventDescription; ?></textarea>
                            <button type="submit" class="btn" name="updateEvent">Update Event</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include('../include/footer.php'); ?>
</div>

<?php include('../include/scripts.php'); ?>