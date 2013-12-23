<?php 
session_start();
// khaled
// main page
include('menu.php');
if(isset($_GET['logout'])) {
session_destroy();
echo "<script>location.replace('index.php');</script>";
}


if(!file_exists('config.php')) echo "<script>location.replace('install.php');</script>";


include('gallery.php');


?>