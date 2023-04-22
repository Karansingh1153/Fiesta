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
    header('Location: show.php');
    exit;
}

// get event details
$id = $_GET['id'];
$festName = $_GET['fest'];
$query = "SELECT * FROM `$festName` WHERE `id` = '$id'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: show.php');
    exit;
}
$row = mysqli_fetch_assoc($result);
$eventName = $row['eventName'];

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    // insert data into database
    $query = "INSERT INTO `registrations` (`eventId`, `name`, `email`, `phone`, `college`, `year`) VALUES ('$eventId', '$name', '$email', '$phone', '$college', '$year')";
    if (mysqli_query($conn, $query)) {
        // registration successful
        header("Location: show.php?success=Registration successful for $eventName!");
        exit;
    } else {
        // registration failed
        $errorMessage = 'Registration failed. Please try again later.';
    }
}
?>
<div class="load">
    <?php include('../include/header.php'); ?>
    <div class="row mx-auto updateFest" id="updateFest">
        <h1 class="text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="500">Update Event</h1>
        <div class="col-md-10 mx-auto">
            <form action="" method="POST">
                <div class="row mx-auto updateFest-col-reverse my-5">
                    <div class="col-12 col-md-12 col-lg-6 updateFest-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="py-4 px-5">
                            <input type="text" class="w-100 my-2" id="name" name="name" placeholder="Name" required>
                            <input type="text" class="w-100 my-2" id="enrollment" name="enrollment" placeholder="Enrollment Number" required>
                            <input type="text" class="w-100 my-2" id="mobile" name="mobile" 
                            placeholder="Mobile Number" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 updateFest-content" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="py-4 px-5">
                            <input type="date" class="w-100 my-2" id="dob" name="dob" placeholder="DOB" required>
                            <input type="text" class="w-100 my-2" id="department" name="department" 
                            placeholder="Department" required>
                            <button type="submit" class="btn w-100" name="updateEvent">Update Event</button>
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