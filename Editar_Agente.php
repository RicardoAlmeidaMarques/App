<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require("/lib/init.php");
?>

<?php
	if(!isset($_SESSION['id']))
	{
		redirect('login.php');
		
	}
	if(permissoes($_SESSION['tipo_agente'],'editar_agente')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar Agentes</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="agentes.php">Agentes</a></font>
</div></div>
<div style="margin-top:80px  ; width:750px; min-height:100%;">
	<form id='editar' action='editar_agente.php?id=<?php echo $_GET['id'];?>' method='post' accept-charset='UTF-8'>
	<fieldset>
	<legend><font size="4">Editar Agente</font></legend>
	<center><table>
				<?php if(isset($_GET['erro']) && $_GET['erro']==2) { echo '<div style="color:red;">Por favor introduza uma palavra passe para este agente.</div>';} ?>
				<?php if(isset($_GET['erro']) && $_GET['erro']==3) { echo '<div style="color:red;">Introduza o nome do agente.</div>';} ?>
				<?php if(isset($_GET['erro']) && $_GET['erro']==4) { echo '<div style="color:red;">Por favor introduza a morada do agente.</div>';} ?>
				<?php if(isset($_GET['erro']) && $_GET['erro']==5) { echo '<div style="color:red;">Por favor introduza o código postal do agente.</div>';} ?>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<tr><td><label for='user' >Código do Agente:</label></td>
				<td><input type="text" name="Código" size="39" disabled="disabled" value="<?php $id=$_GET['id'];$query=mysql_query("Select Codigo_Agente from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Codigo_Agente'];?>"/></td></tr>
				<tr><td><label for='password' >Username:</label></td>
				<td><input type='username' name='username' id='username' maxlength="12" size="39" value="<?php $id=$_GET['id'];$query=mysql_query("Select Nome_Utilizador from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Nome_Utilizador'];?>" DISABLED/></td>
				<td><label for='password' >Password:</label></td>
				<td><input type='password' name='password' id='password' maxlength="12" size="39" value="<?php $id=$_GET['id'];$query=mysql_query("Select Password from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Password'];?>"/></td></tr>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome'  maxlength="100" size="39" value="<?php $id=$_GET['id'];$query=mysql_query("Select Nome_Agente from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Nome_Agente'];?>"/></td>
				<td><label for='Telefone' >Telefone:</label></td>
				<td><input type='text' name='Telefone' id='Telefone'  maxlength="9" size="39" value="<?php $id=$_GET['id'];$query=mysql_query("Select Telefone_Agente from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Telefone_Agente'];?>"/></td></tr>
				<tr><td><label for='Morada' >Morada:</label></td>
				<td><textarea name='morada' id='morada' maxlength="150" rows=7 cols=30 ><?php $id=$_GET['id'];$query=mysql_query("Select Morada_Agente from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Morada_Agente'];?></textarea></td>
				<td><label for='Código_Postal' >Código Postal:</label></td>
				<td><input type='text' name='codigo_postal' id='codigo_postal' size="39"  maxlength="9" value="<?php $id=$_GET['id'];$query=mysql_query("Select Codigo_Postal_Agente from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Codigo_Postal_Agente'];?>"/></td></tr>
				
				<tr><td><label for='Estado' >Estado:</label></td>
				<td><input type="radio" name="estado"size="39"  value="1" <?php $id=$_GET['id'];$query=mysql_query("Select Status from Agente where ID_Agente=$id");$row=mysql_fetch_assoc($query); if($row['Status']==1){ echo 'checked';} ?>> Activo
				<input type="radio" name="estado" size="39" value="0" <?php $id=$_GET['id'];$query=mysql_query("Select Status from Agente where ID_Agente=$id"); $row=mysql_fetch_assoc($query); if($row['Status']==0){ echo 'checked';} ?>> Inactivo</td>
				<td><label for='Tipo_de_Agente' >Tipo de Agente:</label></td>
				<td><select name="tipo_agente" style="width:265px;">

				<?php
				$query=mysql_query("Select ID_Tipo_Agente from Agente where ID_Agente=$id"); $row=mysql_fetch_assoc($query); $ID_Tipo=$row['ID_Tipo_Agente'];
				$query=mysql_query("Select ID_Tipo_Agente, Nome_Tipo from Tipo_Agente Where Status=1 order by ID_Tipo_Agente");
				while ( $dropdown = mysql_fetch_array($query) ){
				if($dropdown["ID_Tipo_Agente"]==$ID_Tipo)
				{
				echo("<option selected value=". $dropdown["ID_Tipo_Agente"]. ">" . $dropdown["Nome_Tipo"] . "</option>");
				}
				else
				{
				echo("<option value=". $dropdown["ID_Tipo_Agente"]. ">" . $dropdown["Nome_Tipo"] . "</option>");
				}
				}
				?>
				</select></td>
	</table></center>
	<br>
				<div align=right><input type="submit" name="form-submitted" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='editar_agentes.php?pag=1'" value="Cancelar"></div>
				
				<?php
				if(isset($_POST['form-submitted'])) {
				if($_POST['password']=="")
				{
					redirect('editar_agente.php?id='. $_GET["id"] . '&erro=2');exit;}
				elseif($_POST['Nome']=="")
				{
					redirect('editar_agente.php?id='. $_GET["id"] . '&erro=3');exit;}
				elseif($_POST['morada']=="")
				{
					redirect('editar_agente.php?id='. $_GET["id"] . '&erro=4');exit;}
				elseif($_POST['codigo_postal']=="")
				{
					redirect('editar_agente.php?id='. $_GET["id"] . '&erro=5');exit;}
				elseif($_POST['Telefone']==""){
					$_POST['Telefone']=0;
				}
				Editar_Agente($_GET['id'], htmlentities($_POST['tipo_agente'], ENT_QUOTES, "UTF-8"),  htmlentities($_POST['password'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"), $_POST['Telefone'], htmlentities($_POST['morada'], ENT_QUOTES, "UTF-8"), $_POST['codigo_postal'], $_POST['estado']);
				redirect('editar_agentes.php?pag=1&success=true');
				}
				
				?>
</div></div></div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>

</html>
