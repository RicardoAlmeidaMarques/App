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
	if(permissoes($_SESSION['tipo_agente'],'adicionar_agente')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar Agente</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="agentes.php">Agentes</a></font>
</div></div>
<div style="margin-top:80px  ; width:750px; min-height:100%;">
	<form id='editar' action='adicionar_agente.php' method='post' accept-charset='UTF-8'>
	<fieldset>
	<legend><font size="4"><font size="4">Adicionar agente</font></font></legend>
	<table>
				
				<input type='hidden' name='submitted' size="39" id='submitted' value='1'/>
				<tr><td><label for='user' >Username:</label></td>
				<td><input type='text' name='username' size="39" id='username'  maxlength="12" /></td><?php if(isset($_GET['erro']) && $_GET['erro']==1) { echo '<div style="color:red;">Nome de utilizador não disponível. Por favor escolha outro.</div>';} ?><?php if(isset($_GET['erro']) && $_GET['erro']==6) { echo '<div style="color:red;">Por favor introduza um nome de utilizador.</div>';} ?>
				<td><label for='password' >Password:</label></td>
				<td><input type='password' name='password' size="39" id='password' maxlength="12" /></td><?php if(isset($_GET['erro']) && $_GET['erro']==2) { echo '<div style="color:red;">Por favor introduza uma palavra passe para este agente.</div>';} ?></tr>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome' size="39"  maxlength="100" /></td><?php if(isset($_GET['erro']) && $_GET['erro']==3) { echo '<div style="color:red;">Introduza o nome do novo agente.</div>';} ?>
				<td><label for='Telefone' >Telefone:</label></td>
				<td><input type='text' name='Telefone' id='Telefone' size="39"  maxlength="9" /></td></tr><?php if(isset($_GET['erro']) && $_GET['erro']==8) { echo '<div style="color:red;">Introduza um número de telefone válido.</div>';} ?>
				<tr><td><label for='Morada' >Morada:</label></td>
				<td><textarea name='morada' id='morada' maxlength="150" rows=7 cols=30 ></textarea></td><?php if(isset($_GET['erro']) && $_GET['erro']==4) { echo '<div style="color:red;">Por favor introduza a morada do agente.</div>';} ?></tr>
				<tr><td><label for='Código_Postal' >Código Postal:</label></td>
				<td><input type='text' name='codigo_postal' id='codigo_postal' size="39"  maxlength="9" /></td><?php if(isset($_GET['erro']) && $_GET['erro']==5) { echo '<div style="color:red;">Por favor introduza o código postal do novo agente.</div>';} ?>
				<td><label for='Tipo_de_Agente' >Tipo de Agente:</label></td>
				<td><select name="tipo_agente" style="width:265px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Agente, Nome_Tipo from Tipo_Agente Where Status=1 order by ID_Tipo_Agente DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				echo("<option value=". $dropdown["ID_Tipo_Agente"]. ">" . $dropdown["Nome_Tipo"] . "</option>");
				}
				
				?>
				</select></td></tr>
	</table>
	<br>
				<div align=right><input type="submit" name="form-submitted" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='agentes.php'" value="Cancelar"></div>
	</form>
				<?php
				if(isset($_POST['form-submitted'])) {
				if(verificar_nome_utilizador(htmlentities($_POST["username"], ENT_QUOTES, "UTF-8"))==1)
				{
					redirect('adicionar_agente.php?erro=1');
				}
				elseif($_POST['username']=="")
				{
					redirect('adicionar_agente.php?erro=6');}
				elseif($_POST['password']=="")
				{
					redirect('adicionar_agente.php?erro=2');}
				elseif($_POST['Nome']=="")
				{
					redirect('adicionar_agente.php?erro=3');}
				elseif($_POST['morada']=="")
				{
					redirect('adicionar_agente.php?erro=4');}
				elseif($_POST['codigo_postal']=="")
				{
					redirect('adicionar_agente.php?erro=5');}
				elseif($_POST['Telefone']==""){
					$_POST['Telefone']=0;
				}
				elseif(!is_numeric($_POST['Telefone'])){
					redirect('adicionar_agente.php?erro=8');}
				 
					Adicionar_Agente($_POST['tipo_agente'], htmlentities($_POST['username'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['password'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"),$_POST['Telefone'], htmlentities($_POST['morada'], ENT_QUOTES, "UTF-8"),  $_POST['codigo_postal']);
					redirect('agentes.php?success=true');
				 }
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
