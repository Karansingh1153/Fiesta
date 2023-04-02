<?php
session_start();

include('./include/head.php');
include('../common/include/loading.php');
include('./include/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Links -->
    <link rel="shortcut icon" href="./common/assets/img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link rel="stylesheet" href="./common/assets/css/global.css" />
    <link rel="stylesheet" href="./common/assets/css/header.css" />
    <link rel="stylesheet" href="./common/assets/css/footer.css" />
    <link rel="stylesheet" href="./common/assets/css/form.css" />
    <link rel="stylesheet" href="./common/assets/css/home.css" />
    <link rel="stylesheet" href="./common/assets/css/loading.css" />
    <link rel="stylesheet" href="./common/assets/css/service.css" />
    <link rel="stylesheet" href="./common/assets/css/pricing.css" />
    <link rel="stylesheet" href="./common/assets/css/gallery.css" />
    <link rel="stylesheet" href="./common/assets/css/about.css" />
    <link rel="stylesheet" href="./common/assets/css/contact.css" />
    <link rel="stylesheet" href="./common/assets/css/review.css" />
    <link rel="stylesheet" href="./common/assets/css/organize.css" />
    <link rel="stylesheet" href="./common/assets/css/universityFest.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9.1.0/swiper-bundle.min.css">

    <title>Fiesta</title>
</head>

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
                                    <a href="../university/universityFest.php" data-aos="fade-down" data-aos-duration="500">Fest</a>
                                </div>
                                <div class="col-12 col-ld-4 col-lg-4 my-5 d-flex justify-content-center" data-aos="zoom-in" data-aos-duration="800">
                                    <a href="../university/universityEvent.php" data-aos="fade-down" data-aos-duration="500">Event</a>
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
    include('../common/include/footer.php');
    include('../common/include/scripts.php');
    ?>

</div>