<?php
include('./common/include/head.php');
include('./common/include/loading.php');
?>

<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="./forgotPasswordBackSendMail.php" method="post">
                        <div class="py-4 px-5">
                            <h2 class="login">Forgot Password</h2>
                            <?php
                            if (isset($_GET['error'])) {
                            ?>
                                <div class="error-space">
                                    <p class="error text-center"><?php echo $_GET['error']; ?></p>
                                </div>
                            <?php } ?>
                            <input type="email" class="w-100" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email">
                            <div class="mx-auto d-flex justify-content-center">
                                <button class="btn mt-4" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./common/include/scripts.php');
?>