<?php
// if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
//     header("Location: ../account.php?cookie=unset");
// } else {
session_start();
session_unset();
session_destroy();
header("Location: ../account.php?info=logout");
// header("");
// }