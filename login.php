<?php
include('./common/include/db_conn.php');
include('./common/include/head.php');
include('./common/include/loading.php');
include('./common/include/config-google.php');
// include('./common/include/config-facebook.php');

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}


$login_google = '<a href="./common/include/config-google.php" class="mx-2"><i class="bi bi-google" id="google"></i></a>';
$login_fb = '<a href="./common/include/config-facebook.php" class="mx-2" id="facebook"><i class="bi bi-facebook"></i></a>';
?>
<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="./loginBack.php" method="post">
                        <span class="d-flex justify-content-center align-items-center">
                            <button id="guest" class="role" type="submit" name="guest" onclick="setRoleGuest();">Guest</button>
                            <button id="organizer" class="role" type="submit" name="organizer" onclick="setRoleOrganizer();">Organizer</button>
                        </span>
                        <div class="py-4 px-5">
                            <h2 class="login" id="loginText">LogIn</h2>
                            <?php
                            if (isset($_GET['error'])) {
                            ?>
                                <div class="error-space">
                                    <p class="error text-center"><?php echo $_GET['error']; ?></p>
                                </div>
                            <?php } ?>
                            <input type="email" class="w-100" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email">
                            <input type="password" class="w-100 my-4" name="password" required id="password" placeholder="Password">
                            <div class="mx-auto d-flex justify-content-center">
                                <button class="btn my-2" type="submit" name="submit">Login</button>
                            </div>
                            <div class="other-login d-flex align-items-center text-center justify-content-center">
                                <hr style="width: 5vw;">
                                <p class="text-center mx-3 my-4">OR</p>
                                <hr style="width: 5vw;">
                            </div>
                            <div class="login_extra text-center">
                                <?php
                                echo $login_google;
                                echo $login_fb;
                                ?>
                            </div>
                            <a class="d-flex justify-content-center mt-3 same-a" href="./common/forgotPassword.php">Forgot Password</a>
                            <a class="d-flex justify-content-center mt-3 same-a" href="signup.php">Don't have account Signup</a>
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

<script>
    const organizer = document.getElementById("organizer");
    const guest = document.getElementById("guest");
    const loginText = document.getElementById("loginText");

    function setRoleGuest() {
        guest.style.borderBottom = "2px solid orange";
        organizer.setAttribute.name = "guest";
        organizer.style.borderBottom = "2px solid white";
        loginText.innerHTML = "Guest Login";
    }

    function setRoleOrganizer() {
        guest.style.borderBottom = "2px solid white";
        organizer.style.borderBottom = "2px solid orange";
        guest.setAttribute.name = "organizer";
        loginText.innerHTML = "Organizer Login";
    }

    guest.addEventListener("click", function(event) {
        event.preventDefault();
    });
    organizer.addEventListener("click", function(event) {
        event.preventDefault();
    });
</script>