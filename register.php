<?php
session_start();
/* 
 khaled
registration page !

*/
include('menu.php');
include('connect.php');



/* check for a logged user trying to register ( dumb / pentester) */
if(!empty($_SESSION['logged']) && !empty($_SESSION['user'])) {
print '<script>
alert("The is no Reason to register again \n you are allready a member");location.replace("index.php");
</script>';

}

if($_POST['register']) {

/* dumb errors detection */
if(empty($_POST['user']) || empty($_POST['pass'])) die("<script>alert('please fill in all fields');history.back();</script>");
if($_POST['pass'] !== $_POST['repass']) die("<script>alert('passwords are not the same');history.back();</script>");
if(preg_match('/</',$post['user'])) die("<script>alert('invalid username');history.back();</script>");
/* ------------------------ */

connect();

$q = mysql_query('select * from users');
$q = mysql_num_rows($q);
$q = mysql_query("select id from users where id = {$q}");
$q = mysql_fetch_row($q);
$q = $q[0]+1;


for($i=0;$i<=$q;$i++) {

$c = mysql_query("select user from users where id = {$i}");
$c = mysql_fetch_row($c);

if($c[0] == $_POST['user']) die('<script>alert("Error : this username has been allready taken ! \n sorry : but you have to choose another name");history.back();</script>');

}

$c = inc();
$que = mysql_query("

INSERT INTO {$c['data']}.users(
`id` ,
`user` ,
`pass`
)
VALUES (
'$q', '$user', '$pass'
);

") or die(mysql_error());

if($que) print '
<script>alert("success \n you are now a member among us \n i hope you enoy it !");location.replace("index.php");</script>
';
else die('<script>alert("Error ! \n please try again ");history.back();</script>');

}


else {
?>
<center><h2>Join us !</h2></center><br>
<li>welcome to the registration page , here you can be one of us , and enjoy the website features , <br>so please fill in this fields to complete your registration.</li>
<br><br><br>
<center>
<form class="f" method="post">
<table>
<tr>
	<td>username : </td>
	<td><input type="text" name="user" placeholder="username"></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
	<td>password : </td>
	<td><input type="password" name="pass" placeholder="password"></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
	<td>retype the password : </td>
	<td><input type="password" name="repass" placeholder="repassword"></td>
</tr>	
<tr>
<td></td>
</tr>
<tr>
	<td>
	<input type="submit" name="register" value="register">
	<input type="reset" value="cancel">
	</td>
</tr>
</table>
</form>
</center>
<?php
}

?>