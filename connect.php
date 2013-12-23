<?php 
// khaled
/* --------------- Database connection functions ------------ */
if(!file_exists('config.php')) echo "<script>location.replace('install.php');</script>";
function inc() {
include('config.php');

return array('user' => $duser , 'host' => $dhost , 'pass' => $dpass , 'data' => $ddata);

}

function connect() {

$c = inc();

mysql_connect($c['host'],$c['user'],$c['pass']);
mysql_select_db($c['data']);

}

/*-------------------------------------------------------------------*/
?>