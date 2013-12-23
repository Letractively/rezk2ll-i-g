<title>REZK2LL : Image Gallery</title>
<link href="style.css" rel="stylesheet" type="text/css">
<br><br><br><br><br><br>


<?php
error_reporting(0);
define(script , '(ReZK2LL : Image Gallery)');
define(dol , '$');
function error($e) {
if($e == 1)
echo <<<k
<h2>Error : </h2><br>
<p>i could not connect to the database server , it could be that your database informations are wrong <br> please check them again .</p><br>
k;

elseif($e == 3)
echo '
<h2>something wrong detected : </h2><br>
<p>i see that you are trying to reinstall '.script.' Again</p><br>
<p>actually you cannot do that , this is script is allready installed .</p>
<br>
';

elseif($e == 2)
echo <<<k
<h2>Error</h2>
<p>i couldn't connect to the database <br> check if you have selected that you haven't created the database first or create it and select 'yes'</p>
<br>
k;

echo '<input type="button" onclick="history.back()" value="<< go back">';
die();
}



if(file_exists('config.php')) error(3);




if($_POST['install']) {

mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']) or error(1);


if($_POST['exist'] == 'yes') {
mysql_query("CREATE DATABASE {$_POST['dbname']};"); 
}

mysql_select_db($_POST['dbname']) or error(2);

# create users table
mysql_query("
CREATE TABLE `users` (
`id` INT NOT NULL ,
`user` VARCHAR( 10 ) NOT NULL ,
`pass` VARCHAR( 30 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;
");
# create images tabel
mysql_query("
CREATE TABLE `images` (
`id` INT NOT NULL ,
`link` VARCHAR( 100 ) NOT NULL ,
`user` VARCHAR( 10 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;
");
mysql_close();


$config  = "<?php \n";
$config .= dol."dhost 		=  		'{$_POST['host']}' ; \n";
$config .= dol."duser 		= 		'{$_POST['user']}' ; \n";		
$config .= dol."dpass 		= 		'{$_POST['pass']}' ; \n";
$config .= dol."ddata 		= 		'{$_POST['dbname']}' ; \n";
$config .= "?>";
file_put_contents('config.php',$config);



echo <<<k
<h2>ok , everything went well</h2>
<br>
<input type='button' onclick="location.replace('index.php')" value="let's go">
k;

}
else {
?>
<h2>Welcome To Installation Section !</h2>
<br>
<p>In order to install <?php echo script; ?> you must fill in this fields with your Database informations.</p>
<br>
<form class="f" method="post">
<table>
<tr>
<td>Host :</td>
<td><input type="text" 	   name="host" placeholder="Database Host"></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
<td>Username :</td>
<td><input type="text" 	   name="user" placeholder="Database username"></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
<td>password :</td>
<td><input type="password" name="pass" placeholder="Database password"></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
<td>Name :</td>
<td><input type="text" 	   name="dbname" placeholder="Database name"></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
<td>have you created this Database before : <br>yes <input type="radio" name="exist" value="yes"> no <input type="radio" name="exist" value="no"></td>
</tr>
<tr>
<td><br><br></td>
</tr>
<tr>
<td>
<input type="submit" name="install" value="install">
<input type="reset" value="cancel">
</td>
</table>
</form>
<?php } ?>