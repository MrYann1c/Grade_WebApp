<?php
session_start();

$db = new SQLite3('sqlite/webapp.db');

$fkuser = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM events WHERE fk_user = :user AND deleted = 'false' ORDER BY date ASC");
$sql->bindValue('user',$fkuser);

$result = $sql->execute();

$now = date("Y-m-d");

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $id = $row['event_id'];
    $name = $row['eventname'];
    $date = $row['date'];
    $time = $row['time'];
    $desc = $row['description'];
    $priority = $row['priority'];
        
    if ($priority == "h") {
        $color = "rgba(230, 25, 25, 0.56);";
    }
    else if ($priority == "m") {
        $color = "rgba(25, 107, 230, 0.56);";
    }
    else if ($priority == "l") {
        $color = "rgba(25, 230, 25, 0.56)";
    }
    else {
        $color = "silver";
    }
    echo "<div style='border: 5px inset $color;'>";
       if ($date == $now) {
        echo "<div style='background-color:black;position:absolute;width:100%;height:10%;display:flex;justify-content:center;align-items:center;font-size:0.5em;opacity: 0.6;'>
            <h1>TODAY</h1>
        </div>";
       }
        echo "<p class='title' style=''>$name</p>
            <p>$date</p>
            <p>$time</p>
            <p>$desc</p>
            <form action='calendar/delete_events.php' method='POST'>
                <input type='submit' name='e-delete' class='delete-event' value='Delete Event'>
                <input type='text' name='event_id' style='position:absolute;display:none;' value='$id'>
            </form>
        </div>";
}