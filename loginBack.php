<?php
session_start();

if(isset($_POST['submit'])){
    include('./include/db_conn.php');

    if (isset($_SESSION['username'])) {
        header('Location: index.php');
    }
    
    if (isset($_POST['email']) && isset($_POST['password'])) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes(($data));
            $data = htmlspecialchars($data);
            return $data;
        }
    }
    
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $epass = $row['password'];
        $check = password_verify($pass, $epass);
        if ($row['email'] === $email && $check) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['logged_in'] = true;
            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                exit;
            } else {
                if ($row['role'] == 'organizer')
                    header("Location: organizer/organizer.php");
                if ($row['role'] == 'invitee') {
                    header('Location: index.php');
                }
            }
            // header("Location: index.php?user");
            exit();
        } else {
            header("Location: login.php?error=Incorrect email or password");
            exit();
        }
    } else {
        header("Location: login.php?error=Incorrect email or password");
        exit();
    }
}
else{
    header('Location: login.php');
}

