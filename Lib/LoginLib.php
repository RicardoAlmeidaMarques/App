<?php

function valid_user_and_password($user, $password) {
	$query = mysql_query("select ID_Agente, Password from Agente where Nome_Utilizador='$user'");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	if (mysql_num_rows($query) > 0) {
		$row = mysql_fetch_assoc($query);
		If ($row['Password']==$password)
			{
			Return $row['ID_Agente'];
			}else {return -1;}  //pasword incorrecta
	}else {
		return 0;  //não existe o utilizador
	}
}


	
function tipo_agente($id) {
	$query = mysql_query("select Tipo_Agente.ID_Tipo_Agente from Tipo_Agente, Agente where Agente.ID_Tipo_Agente=Tipo_Agente.ID_Tipo_Agente and Agente.ID_Agente=$id");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	return $row['ID_Tipo_Agente'];
	}
	
function permissoes($tipo_agente,$accao){
	$query=mysql_query("select $accao from Tipo_Agente where ID_Tipo_Agente=$tipo_agente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	return $row[$accao];
	}
	
	

function redirect ($url) {
	header("location: $url");
}

?>