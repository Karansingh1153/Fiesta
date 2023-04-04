<?php
include('./include/head.php');
include('./include/loading.php');
?>

<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="resetPasswordBack.php?token=<?php echo $_GET['token'] ?>" method="post">
                        <h2 class="login">Reset Password</h2>
                        <?php
                        if (isset($_GET['error'])) {
                        ?>
                            <div class="error-space">
                                <p class="error text-center"><?php echo $_GET['error']; ?></p>
                            </div>
                        <?php } ?>
                        <input type="password" class="w-100 my-4" name="newpassword" required id="npassword" placeholder="New Password">
                        <input type="password" class="w-100 my-4" name="cnewpassword" required id="cnpassword" placeholder="Confirm New Password">
                        <div class="mx-auto d-flex justify-content-center">
                            <button class="btn my-2" type="submit">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./include/scripts.php');
?>