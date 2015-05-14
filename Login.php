<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php
require("/lib/init.php");


?>
<head>
<link rel="stylesheet" href="/Css/Login_Styles.css" type="text/css" />
</head>
<body>
<div class="main_container">
<div class="login_form">
<table>

<form id='login' action='Login.php' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<tr><td><label for='user' ><b>Username:</b></label></td>
				<td><input type='text' name='username' id='username'  maxlength="12" /></td></tr>
				<tr><td><label for='password' ><b>Password:</b></label></td>
				<td><input type='password' name='password' id='password' maxlength="12" /></td></tr></table>
				<div style="text-align:right; margin-right:-8px; margin-top:4px;"><input type="submit" name="form-submitted" value="Sign in" /></div>
				
				<?php
				if(isset($_POST['form-submitted'])) {
				if((valid_user_and_password($_POST['username'], $_POST['password']))>0) {
				$user=$_POST['username'];
				$query=mysql_query("Select Nome_Agente from Agente where Nome_Utilizador='$user'");
				if (!$query) { die('Invalid query: ' . mysql_error()); }
				$row=mysql_fetch_assoc($query);
				$Nome=$row['Nome_Agente'];
				$_SESSION['Nome']=$Nome;
				$_SESSION['id'] = (valid_user_and_password($_POST['username'], $_POST['password']));
				redirect('Index.php');
				} else {
					if((valid_user_and_password($_POST['username'], $_POST['password']))==0)
					{
						echo '<div style="color:#B22222; text-align: justify; font-weight:bold;">Username incorrecto. Atenção a maiúsculas/minúsculas.</div>';
					}
					if((valid_user_and_password($_POST['username'], $_POST['password']))==-1)
					{
						echo '<div style="color:#B22222; text-align: justify; font-weight:bold;">Password incorrecta. Atenção a maiúsculas/minúsculas.</div>';
					}
				}
				}
				?>
</form>
</div>
</div>
</body>
</html>
