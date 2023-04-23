<?php
session_start();

include('../include/head.php');
include('../include/loading.php');
include('../include/db_conn.php');

// check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

// check if event id is passed through URL
if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
} else {
    // get event details
    $id = $_GET['id'];
    $festName = $_GET['fest'];
    $query = "SELECT * FROM `$festName` WHERE `id` = '$id'";
    echo $festName;
    echo $id;
    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        header('Location: ../index.php');
        exit;
    } else {
        $row = mysqli_fetch_assoc($result);
        $eventName = $row['eventName'];
        $eventId = $row['eventId'];
        echo $eventId;
        // handle form submission
    }
    if (isset($_POST['register'])) {
        // retrieve form data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $enrollment = mysqli_real_escape_string($conn, $_POST['enrollment']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);

        // insert data into database
        $query = "INSERT INTO `registrations` (`eventId`, `eventName`, `name`, `enrollment`, `mobile`, `dob`, `department`) VALUES ('" . $eventId . "', '" . $eventName . "', '" . $name . "','" . $enrollment . "','" . $mobile . "','" . $dob . "','" . $department . "')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            // registration successful
            header("Location: ../index.php");
            exit;
        } else {
            header('Location: ./invitee/show.php?error=Registration Failure.');
        }
    }
}
?>
<div class="load">
    <?php include('../include/header.php'); ?>
    <div class="row mx-auto registerFest" id="registerFest">
        <h1 class="text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="500">Register Event</h1>
        <div class="col-md-10 mx-auto">
            <form <?php echo "action=register.php?id=".$id."&&fest=".$festName."" ?> method="POST">
                <div class="row mx-auto registerFest-col-reverse my-5">
                    <div class="col-12 col-md-12 col-lg-6 registerFest-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="px-5">
                            <input type="text" class="w-100 my-2" id="name" name="name" placeholder="Name" required>
                            <input type="text" class="w-100 my-2" id="enrollment" name="enrollment" placeholder="Enrollment Number" required>
                            <input type="text" class="w-100 my-2" id="mobile" name="mobile" placeholder="Mobile Number" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 registerFest-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="px-5">
                            <input type="date" class="w-100 my-2" id="dob" name="dob" placeholder="DOB" required>
                            <input type="text" class="w-100 my-2" id="department" name="department" placeholder="Department" required>
                            <button type="submit" class="btn w-100" name="register">Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    include('../include/footer.php');
    include('../include/scripts.php');
    ?>
</div>