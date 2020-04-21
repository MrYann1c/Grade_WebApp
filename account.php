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
            <?php
                if (isset($_SESSION['userID']) && ($_SESSION['userUID'])) {
                    echo '<form action="login/logout.php" method="POST">
                        <button class="logout">Logout</button>
                        </form>';
                } else {
                }
            ?>
            </div>
        </div>
        <div class="main">
            <div class="form">
            <?php
                if (isset($_SESSION['userID']) && ($_SESSION['userUID'])) {
                    echo "<div>";
                    echo "<p>Username: " .$_SESSION['userUID'] ."</p>";
                    echo "<p>Email: ".$_SESSION['userMAIL']."</p>";
                    echo "<a href='changepassword.php'>Change Password</a>";
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
        </div>
    </div>
</body>
</html>
