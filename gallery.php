<?php 
include('connect.php');

connect();


$q = mysql_query("SELECT * FROM images");
$q = mysql_num_rows($q);

echo '<center><table class="art">';
for($i=1;$i<=$q;$i++) {

$a++;
$b++;

$link = mysql_query("SELECT link FROM images WHERE id = {$i}");
$link = mysql_fetch_row($link);

$us = mysql_query("SELECT user FROM images WHERE id = {$i}");
$us = mysql_fetch_row($us);

if($a == 1) {
echo "<tr>";
}
echo "<td class='gal'><img width='200' height='200' src='{$link[0]}'><br>Uploaded by : {$us[0]}</td>";

if($b == 4) {
$a = 0;
$b = 0;

echo "</tr>
<tr>
<td><br><br></td>
</tr>
";
}

else echo "<td></td>";
}
echo '</table></center>';








?>