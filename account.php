<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Account</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="account">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="#" class="active">Account</a>
                </div>
            </div>
            <div class="right-side">
            <img src="images/logo.png" class="logo" alt="logo"/>
            <?php
            if (isset($_GET['login'])) {
                //echo '<script>alert("Successfully logged in!");</script>';
                echo '<div><p class="success">Successfully logged in!</p></div>';
            }
            ?>
            <?php
                if (isset($_SESSION['userID']) && ($_SESSION['userUID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                } else {
                }
            ?>
            </div>
        </div>
        <div class="main">
            <div class="form">
            <?php
                if (isset($_SESSION['userID']) && ($_SESSION['userUID'])) {
                    $uid = $_SESSION['userUID'];
                    $mail = $_SESSION['userMAIL'];
                    $group = $_SESSION['userGRP'];

                    $sessionid = $_SESSION['userID'];
                    $sessionuid = $_SESSION['userUID'];
                    $sessionmail = $_SESSION['userMAIL'];
                    $sessiongroup = $_SESSION['userGRP'];

                    $php = "<?php include 'group/select_group.php'; ?>";
                    echo "<form action='login/change_login.php' method='post'>";
                    echo "<div class='account-logged'>";
                    echo "<button class='btn-logged' id='edit-btn' type='button' onclick='edit()'>Edit</button>";
                    echo "<button name='change' class='btn-logged' id='save-btn' type='submit'>Save</button>";
                    echo "<button class='btn-logged' id='cancel-btn' type='button' onclick='cancel()'>Cancel</button>";
                    echo "<p>Username</p><div class='div-logged'><input class='input-logged' id='i-uid' name='change-uid' value='$uid' disabled></div>";
                    echo "<p>Email</p><div class='div-logged'><input class='input-logged' id='i-mail' name='change-mail' value='$mail' disabled></div>";
                    echo "<p>Group</p><div class='div-logged'><select name='change-group' class='select-logged' id='s-group' disabled>";
                    echo include 'group/select_group.php';;
                    echo "</select></div>";
                    echo "</form>";
                    echo "<br><br><a href='changepassword.php'>Change Password</a>";
                    echo "<form action='login/logout.php' method='post'><button class='logout'>Logout</button></form>";
                    echo "</div>";
                } else {
                    echo '<form action="login/check_login.php" method="post">
                    <div>
                        <label for="a-username">Username</label><br>
                        <input type="text" step="0.1" name="a-username" required>
                    </div>
                    <div>
                        <label for="a-password">Password</label><br>
                        <input type="password" name="a-password" required>
                    </div>
                    <div>
                        <a href="#" id="a-float">Forgot Password?</a>
                    </div>
                    <div>
                        <a href="register.php">Sign Up</a>
                    </div>
                    <button name="login" type="submit" value="Login">Login</button>
                </form>';
                }
            ?>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS ©</div>
        </div>
    </div>
    <script src="js/change.js"></script>
</body>
</html>
