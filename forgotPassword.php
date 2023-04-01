<?php
include('./include/head.php');
include('./include/loading.php');
?>

<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="./forgotPasswordBackSendMail.php" method="post">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./include/scripts.php');
?>