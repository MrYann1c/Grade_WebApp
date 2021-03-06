<!DOCTYPE html>
<?php include "calendar/db_events.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet/less" type="text/css" href="css/calendar.less"/>
    <title>Grades | Calendar</title>
</head>
<body>
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div><a href="classes.php" class="burger-link">Classes</a></div>
        <div><a href="account.php" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">

        <div><a href="grades.php" class="burger-link">Grades</a></div>
        <div><a href="gallery.php" class="burger-link">Gallery</a></div>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="#" class="burger-link burger-link-active">Calendar</a></div>
    </div>
</div>

<!-- Burger Icon -->
<div class="burger-icon" onclick="burger(this)">
    <div class="bar1"></div>
    <div class="bar2"></div>
    <div class="bar3"></div>
</div>

<div class="container">
    <div class="submission" id="e-sub">
        <div class="back" id="e-back">
            <button onclick="hideshow()" id="e-btn">Hide</button>
        </div>
        <!-- <div id="e-bar"></div> -->
        <!-- <div id="e-back2">
            <a href="account.php" id="b-btn">Back</a>
        </div> -->
        <form action="calendar/insert_events.php" method="GET" id="eform">
            <div>
                <label for="e-name">Eventname</label>
                <input type="text" name="e-name">
                <div class="border"></div>
            </div>
            <div>
                <label for="e-date">Date</label>
                <input type="date" name="e-date">
                <div class="border"></div>
            </div>
            <div>
                <label for="e-time">Time</label>
                <input type="time" name="e-time">
                <div class="border"></div>
            </div>
            <div>
                <label for="">Reminder</label>
                <select name="e-reminder" id="reminder">
                    <option value="-">-</option>
                    <option value="1d">1 day before</option>
                    <option value="2d">2 days before</option>
                    <option value="1w">1 week before</option>
                </select>
                <div class="border"></div>
            </div>
            <div>
                <label for="">Priority</label>
                <select name="e-priority" id="priority">
                    <option value="-">-</option>
                    <option value="h" style="color:red;">High</option>
                    <option value="m" style="color:blue;">Medium</option>
                    <option value="l" style="color:green;">Low</option>
                </select>
                <div class="border"></div>
            </div>
            <div>
                <label for="e-description">Description</label>
                <textarea rows="5" cols="50" name="e-description" placeholder=""></textarea>
                <div class="border"></div>
            </div>
            <div>
                <input type="submit" name="e-submit" value="Add Event" id="e-add">
            </div>
        </form>
    </div>
        <div class="calendar">
            <?php include "calendar/select_events.php"; ?>
        </div>
</div>
<script src="js/calendar.js"></script>
<script src="js/burger-grades.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>