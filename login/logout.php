<?php
// if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
//     header("Location: ../account.php?cookie=unset");
// } else {
session_start();
session_unset();
session_destroy();
// header("Location: ../account.php?info=logout");
header("Location: https://login-i-ng.xtra.netwatch.ch/auth/realms/MSP/protocol/openid-connect/logout?redirect_uri=https%3A%2F%2Fgrades-i.spie.ch");
// }