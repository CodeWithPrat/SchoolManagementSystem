<?php
session_start();
unset($_SESSION['adminUserid']);
unset($_SESSION['admin']);
header("Location:index.php");
?>