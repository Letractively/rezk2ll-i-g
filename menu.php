<?php

if(empty($_SESSION['logged'])) {
$statue = "<td width='25%'><a href='register.php' title='go register'><div class='c'>Join us</div></a></td>";
$log = "<td width='25%'><a href='login.php' title='log in'><div class='c'>login</div></a></td>";
}
else {
$log = "<td width='25%'><a href='index.php?logout' title='logout'><div class='c'>logout <font color='red'>{$_SESSION['user']}</font></div></a></td>";
$statue ="";
}

$menu = "
<table class='header'>
<tr>
<td width='25%'><a href='index.php' title='home'><div class='c'>Home</div></a></td>
<td width='25%'><a href='upload.php' title='upload your photos'><div class='c'>Upload</div></a></td>
{$log} 
 {$statue}
</tr>
</table>
";

echo $menu;




?>

<title>REZK2LL : Image Gallery</title>
<link href="style.css" rel="stylesheet" type="text/css">
<br><br><br><br><br><br>