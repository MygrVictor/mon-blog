<?php 
require '/Applications/MAMP/htdocs/blog/dist/config.php';
session_start();
session_unset();
header('Location: login.php');
?>
