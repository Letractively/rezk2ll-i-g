<?php 
session_start();
// khaled
// upload page

include('menu.php');
include('connect.php');

/* ------------------------ user logged in check --------------------*/
if(empty($_SESSION['logged']) || empty($_SESSION['user'])) {

die("<script>location.replace('login.php');</script>");

}
/* -----------------------------------------------------------------*/

################## once you hit the button , the next happens ##########
if($_POST['upload']) {
$danger = array('php','phtml','txt','html','js','swf');
foreach($danger as $dang) {
if(preg_match('/'.$dang.'/',$_FILES['image']['name'])) 
die('<script>alert("invalid file name ! change it\n");history.back();</script>');
}
$op = copy($_FILES['image']['tmp_name'],'images/'.$_SESSION['user'].'_'.$_FILES['image']['name']);

if($op) {
$link = "images/{$_SESSION['user']}_{$_FILES['image']['name']}";
connect();

$c = inc();

$q = mysql_query('select * from images');
$q = mysql_num_rows($q);
$q = mysql_query("select id from images where id = {$q}");
$q = mysql_fetch_row($q);
$q = $q[0]+1;
mysql_query("
INSERT	into {$c['data']}.images 
(`id`,`link` , `user` )
	Values
('{$q}' ,'{$link}' , '{$_SESSION['user']}');
");


mysql_close();
echo "<script>alert('done ! ');history.back()</script>";
}

else die("<script>alert('failed ! ');history.back()</script>");

}

else 
{
?>
<center><h2>Upload your image !</h2></center>
<br>
<li>Please select an image from your computer</li>
<left><p>just <b>images</b> ! , otherwise your file will be deleted !.</p></left>
<form class="f" method="post" ENCTYPE="multipart/form-data">
<center>
<table>
<tr>
<td><br><br></td>
</tr>
<tr>
<td>image : </td>
<td><input type="file" name="image"></td>
</tr>
<tr>
<td>
<input type="submit" name="upload" value="upload">
<input type="reset" value="cancel">
</td>
</tr>
</table>
</form>
</center>
<?php 
}
?>