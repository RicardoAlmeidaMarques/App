<?php
	require("/lib/init.php");
	if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
	}
	$url=$_SESSION['url'];
	$user=$_SESSION['id'];
	$q=mysql_query("update sessoes set logged=0 where user_id=$user");
	session_destroy();
	redirect('login.php');
	?>