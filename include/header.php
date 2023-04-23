<!DOCTYPE html>
<html lang="en">

<body>
    <div class="header">
        <div class="row w-100 mx-auto">
            <div class="col-12 col-md-12 col-lg-12 mx-auto d-flex justify-content-center align-items-center header-footer">
                <header class="container mx-auto">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container">
                            <a class="navbar-brand" href="index.php">
                                <span class="f">F</span>ie<span class="s">s</span>ta
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="Home" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="Gallery" href="#gallery">Gallery</a>
                                    </li>
                                    <?php
                                    if (session_id()) {
                                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'invitee') {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-name="Events" href="#events">Events</a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="Services" href="#service">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="Plans&Pricing" href="#pricing">Plans&Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="AboutUs" href="#about">AboutUs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-name="Contact" href="#contact">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <span class="pipe"></span>
                                    </li>
                                    <?php
                                    if (session_id() != "") {
                                        if (!isset($_SESSION['logged_in'])) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-name="Login" href="login.php">Login</a>
                                            </li>
                                            <?php
                                        } else {
                                            if (isset($_SESSION['username'])) {
                                            ?>
                                                <div class="dropdown-center">
                                                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="drop-list">
                                                            <p class="drop">
                                                                <?php echo $_SESSION['username']; ?>
                                                            </p>
                                                        </li>
                                                        <li class="drop-list">
                                                            <?php
                                                            if (!isset($_SESSION['login_extra'])) {
                                                            ?>
                                                                <p class="drop">
                                                                    <a class="same-a" href="changePassword.php">Change Password</a>
                                                                </p>
                                                            <?php
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li class="drop-list">
                                                            <p class="drop">
                                                                <a href="../logout.php" style="text-decoration:none; color:#ffa502"><i class="bi bi-box-arrow-right"></i>
                                                                    Logout
                                                                </a>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-name="Login" href="login.php">Login</a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <span class="m-2"></span>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>

</body>

</html>