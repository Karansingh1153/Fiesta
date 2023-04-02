<?php
session_start();

include('../common/include/head.php');
include('../common/include/loading.php');
?>


<div class="load">

    <?php
    include('../common/include/organizerHeader.php');
    ?>
    <div class="row mx-auto universityfest">
        <div class="col-md-10 mx-auto">
            <div class="row mx-auto universityfest-col-reverse">
                <div class="col-12 col-md-12 col-lg-6 universityfest-content">
                    <form action="universityFestBack.php" method="post">
                        <?php
                        if (isset($_GET['error'])) {
                        ?>
                            <div class="error-space">
                                <p class="error text-center"><?php echo $_GET['error']; ?></p>
                            </div>
                        <?php } ?>
                        <input type="text" name="festname" id="festname" pattern="[A-Za-z0-9_]{2,20}" class="w-100 my-2" required placeholder="Enter Fest Name ...">
                        <div class="mx-auto d-flex justify-content-center">
                            <button class="btn my-2" type="submit">Create</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-12 col-lg-6" data-aos="zoom-in-down" data-aos-duration="1000">
                    <img src="../common/assets/img/event.png" class="d-block w-100" alt="Event Image">
                </div>
            </div>
        </div>
    </div>
    <?php
    include('../common/include/scripts.php');
    ?>

</div>