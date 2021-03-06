<?php session_start(); ?>
<?php include "login/not_logged.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | Classes</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/main.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="classes">
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="#" class="burger-link burger-link-active">Classes</a></div>
        <div><a href="account.php" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">
        <?php if($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
            echo '<div><a href="overview.php" class="burger-link">User</a></div>';
        } ?>        <div><a href="grades.php" class="burger-link">Grades</a></div>
        <div><a href="gallery.php" class="burger-link">Gallery</a></div>
        <div><a href="calendar.php" class="burger-link">Calendar</a></div>
    </div>
</div>
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                
                <!-- Burger Icon -->
                <div class="burger-icon" onclick="burger(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>

                <div class="nav-link-wrapper" id="a-submit">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="#" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
                <a href="index.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
            </div>
        </div>
        <?php if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                }
                ?>
        <div class="main">
            <div class="form">
                <div class="class-center">
                    <div class="dropdown">
                        <button onclick="dropdown()" id="drpbtn" class="dropdown-btn">Actions</button>
                        <div id="myDropdown" class="dropdown-content">
                            <button onclick="newClass()" type="button" style="font-weight:bold;">Add new Class</button>
                            <a id='g-btn' href='gallery.php' name='g-btn' style="border-top: 1px solid silver;">Gallery</a>
                            <a href='calendar.php'>Calendar</a>
                            <a id='gr-btn' href='grades.php' name='gr-btn'>Grades</a>
                        <?php
                        if (isset($_SESSION['userID'])) {
                            if ($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
                                echo "<a id='user-bb' href='overview.php' name='user-bb'>User</a>";
                            } else {
                            }
                        } else {
                            header("Location: account.php");
                        }
                        ?>
                        </div>
                    </div>
                   <?php
                        if (isset($_GET['user-preview'])) {
                            if ($_SESSION['userGRPID'] == 3) {
                                include 'classes/select_classes_bb.php';
                            } else {
                                header("Location: classes.php");
                            }
                        } else {
                            include 'classes/select_classes.php';
                        }
                    ?>
                </div>
            </div>
            <!--<div id="classadded_container">
                <p id="classadded"></p>
            </div>-->
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/zoom.js"></script>
    <script src="js/main.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/burger.js"></script>
</body>
</html>