<?php
session_start();

include('../include/head.php');
include('../include/loading.php');
include('../include/organizerHeader.php');
?>

<div class="load">
    <?php
    if (isset($_GET['university'])) {
    ?>
        <div class="organize">
            <div class="container">
                <div class="create">
                    <div class="row mx-auto my-5 creator" id="creator">
                        <div class="col-md-10 mx-auto">
                            <div class="row mx-auto hero-creator my-5">
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in-down" data-aos-duration="800">
                                    <a href="universityFest.php" data-aos="fade-down" data-aos-duration="500">Fest</a>
                                </div>
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in" data-aos-duration="800">
                                    <a href="universityEvent.php" data-aos="fade-down" data-aos-duration="500">Event</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="organize">
            <div class="container">
                <div class="create">
                    <div class="row mx-auto my-5 creator" id="creator">
                        <div class="col-md-10 mx-auto">
                            <div class="row mx-auto hero-creator my-5 d-flex justify-content-center">
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in-down" data-aos-duration="800">
                                    <a href="organizer.php?university" name="university" data-aos="fade-down" data-aos-duration="500">University</a>
                                </div>
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in" data-aos-duration="800">
                                    <a href="#" data-aos="fade-down" data-aos-duration="500">Wedding</a>
                                </div>
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in-down" data-aos-duration="800">
                                    <a href="#" data-aos="fade-down" data-aos-duration="500">Meeting</a>
                                </div>
                            </div>
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

</div>