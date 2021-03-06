<?php
if(isset($_POST['register'])) {
    $usern1 = $_POST['r-uid'];
    $username = filter_var($usern1, FILTER_SANITIZE_STRING);
    $email = $_POST['r-email'];
    $passwd = $_POST['r-pwd'];
    $rpasswd = $_POST['r-rpwd'];
    $group = $_POST['r-group'];

    $db = new SQLite3('../sqlite/webapp.db');

    // Check if fields are missing
    if (empty($username) || empty($email) || empty($passwd) || empty($rpasswd)) {
        header("Location: ../register.php?error=emptyfields&r-uid=".$username."&r-email=".$email."&r-group=".$group);
        exit();
    }
    // Check if mail and username are valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../register.php?error=invalidmailusername");
        exit();
    }
    // Check if mail is valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&r-uid=".$username);
        exit();
    }
    // Check if username is correct
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../register.php?error=invalidusername&r-email=".$email);
        exit();
    }
    // Check if passwords match
    else if ($passwd !== $rpasswd) {
        header("Location: ../register.php?error=passwordcheck&r-uid=".$username."&r-email=".$email);
        exit();
    }
    // No group selected
    else if ($group == "") {
        header("Location: ../register.php?error=invalidgroup&r-uid=".$username."&r-email=".$email);
        exit();
    }

    // Check if mail exists
    $mail = $db->prepare("SELECT email FROM login WHERE email=:mail");
    $mail->bindValue(':mail',$email);
    $result = $mail->execute();
    $n_rows = 0;

    while ($row = $result->fetchArray()) {
        $n_rows += 1;
    }
    if ($n_rows == 1) {
        header("Location: ../register.php?error=mailtaken");
        exit();
    }

    // Check if username exists
    $sql = $db->prepare("SELECT username FROM login WHERE username=:uid");
    $sql->bindValue(':uid',$username);
    $r = $sql->execute();

    $n_rows2 = 0;

    // Check number of rows
    while ($row = $r->fetchArray()) {
        $n_rows2 += 1;
    }
    if ($n_rows2 == 1) { // = 1 -> Username already taken - go back to signup page
        header("Location: ../register.php?error=usertaken");
        exit();
    } else { // = 0 -> Username not taken - Insert cred into DB
        $passwordHashed = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = $db->prepare("INSERT INTO login (username,email,passwd,fk_group) VALUES (:uid,:mail,:pwd,:group)");
        $sql->bindValue(':uid',$username);
        $sql->bindValue(':mail',$email);
        $sql->bindValue(':pwd',$passwordHashed);
        $sql->bindValue(':group',$group);
        $r = $sql->execute();
        $db->close();
        header("Location: ../account.php?signup=success");
        exit();
    }
} else { // When accessed manually, send user back to signup page
    header("Location: ../register.php");
    exit();
}