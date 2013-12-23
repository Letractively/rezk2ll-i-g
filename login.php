<?php 
session_start();
// khaled
// login

if(!empty($_SESSION['logged']) && !empty($_SESSION['user'])) {
print "<script>

alert('The is no Reason to login again');
;location.replace('index.php');
</script>";

}
include('menu.php');
include('connect.php');

if($_POST['login']) {




$loguser = trim($_POST['loguser']);
$logpass = trim($_POST['logpass']);


if(empty($loguser) || empty($logpass)) die("<script>alert('please fill all required fields');history.back();</script>");
connect();
$c = inc();
$q = mysql_query("SELECT pass FROM users WHERE user = '{$loguser}' ;");
$dbpass = mysql_fetch_row($q);


if($logpass == $dbpass[0]) {

$_SESSION['logged'] = 1;
$_SESSION['user'] = $loguser;
echo "<script>location.replace('index.php');</script>";
}

else  die('<script>alert("invalid Username or Password \n retry again");history.back();</script> ');

}

else {
?>
<h2>Login</h2><br>
<li>in order to upload your photos , you must login first , by filling in with your username and password.</li>
<center>
<form class="f" method="post">
<table>
<tr>
<td></td>
</tr>
<tr>
<td>Username</td>
<td><input type="text" name="loguser" placeholder="username"></td>
</tr>

<tr>
<td></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="logpass" placeholder="password"></td>
</tr>

<tr>
<td></td>
</tr>
<tr>
<td>
<input type="submit" name="login" value="login">
<input type="reset" value="cancel">
</td>
</tr>
</table>
</form>
</center>
<?php 
}
?>