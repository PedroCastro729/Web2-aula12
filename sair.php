<?php
session_start();
session_destroy();
header("Location: ex2/login.php");
exit;
?>
