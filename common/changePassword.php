<?php
include('./include/head.php');
include('./include/loading.php');
?>

<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="./changePasswordBack.php" method="post">
                        <h2 class="login">Change Password</h2>
                        <?php
                        if (isset($_GET['error'])) {
                        ?>
                            <div class="error-space">
                                <p class="error text-center"><?php echo $_GET['error']; ?></p>
                            </div>
                        <?php } ?>
                        <input type="password" class="w-100 my-2" name="oldpassword" required id="opassword" placeholder="Old Password">
                        <input type="password" class="w-100 my-2" name="newpassword" required id="npassword" placeholder="New Password">
                        <input type="password" class="w-100 my-2" name="cnewpassword" required id="cnpassword" placeholder="Confirm New Password">
                        <div class="mx-auto d-flex justify-content-center">
                            <button class="btn mt-4" type="submit">Change Password</button>
                        </div>
                        <a class="d-flex justify-content-center mt-3 same-a" href="index.php?user">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./include/scripts.php');
?>