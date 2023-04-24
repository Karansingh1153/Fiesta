<?php
include('./include/head.php');
include('./include/db_conn.php');
include('./include/loading.php');
include('./include/config-google.php');
// include('./include/config-facebook.php');

if (isset($_SESSION['logged_in'])) {
    header('Location: index.php');
}

if (isset($_GET["code"])) {
    $code = $_GET['code'];
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $data = $google_service->userinfo->get();

        $userinfo = [
            'email' => $data['email'],
            'first_name' => $data['givenName'],
            'last_name' => $data['familyName'],
            'gender' => $data['gender'],
            'full_name' => $data['name'],
            'picture' => $data['picture'],
            'verified_email' => $data['verifiedEmail'],
            'token' => $data['id']
        ];

        $sql = "SELECT * FROM `google_users` WHERE `email` = '{$userinfo['email']}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            $token = $userdata['token'];
            $_SESSION['username'] = $userdata['full_name'];
            $_SESSION['id'] = $userdata['id'];
            $_SESSION['email'] = $userdata['email'];
            if ($userdata['role'] == 'organizer')
                $_SESSION['role'] = $userdata['role'];
            header("Location: organizer/organizer.php");
            if ($userdata['role'] == 'invitee') {
                $_SESSION['role'] = $userdata['role'];
                header('Location: index.php');
            }
        } else {
            if (!empty($_COOKIE['role'])) {
                $role = $_COOKIE['role'];
                $sql = "INSERT INTO `google_users` (`email`, `first_name`, `last_name`, `full_name`, `picture` ,`verified_email`, `token`, `role`) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}', '{$userinfo['picture']}', '{$userinfo['verified_email']}', '{$userinfo['token']}', '$role')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['username'] = $userinfo['full_name'];
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['email'] = $userinfo['email'];
                    $token = $userinfo['token'];
                    if ($role == 'organizer')
                        $_SESSION['role'] = $role;
                    header("Location: organizer/organizer.php");
                    if ($role == 'invitee') {
                        $_SESSION['role'] = $role;
                        header('Location: index.php');
                    }
                } else {
                    header('Location: login.php?error=Try again later');
                }
            } else {
                header('Location: login.php?error=Please select a role');
            }
        }
        $_SESSION['google_access_token'] = $token;
        $_SESSION['login_extra'] = true;
        $_SESSION['logged_in'] = true;
    } else {
        header('Location: login.php?error=Something went wrong');
    }
}

$login_google = '<a href="' . $google_client->createAuthUrl() . '" class="mx-2"><i class="bi bi-google" id="google"></i></a>';
$login_fb = '<a href="./include/config-facebook.php" class="mx-2" id="facebook"><i class="bi bi-facebook"></i></a>';
?>
<div class="load">
    <div class="form">
        <div class="container">
            <div class="row my-auto">
                <div class="col-md-4 mx-auto">
                    <form action="./loginBack.php" method="post">
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
                                <p class="text-center mx-3 mt-3">OR</p>
                                <hr style="width: 5vw;">
                            </div>
                            <div class="role mb-3">
                                <input type="radio" name="role" value="invitee" id="invitee">
                                <label for="invitee">Invitee</label>
                                <input type="radio" name="role" value="organizer" id="organizer">
                                <label for="organizer">Organizer</label>
                            </div>
                            <div class="login_extra text-center">
                                <?php
                                echo $login_google;
                                echo $login_fb;
                                ?>
                            </div>
                            <a class="d-flex justify-content-center mt-3 same-a" href="forgotPassword.php">Forgot Password</a>
                            <a class="d-flex justify-content-center mt-3 same-a" href="signup.php">Don't have account Signup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("invitee").addEventListener("change", function() {
        var value = document.querySelector('input[name="role"]:checked').value;
        document.cookie = "role=invitee";
    });

    document.getElementById("organizer").addEventListener("change", function() {
        var value = document.querySelector('input[name="role"]:checked').value;
        document.cookie = "role=organizer";
    });
</script>

<?php
include('./include/scripts.php');
?>