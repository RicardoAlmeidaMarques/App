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
	if(permissoes($_SESSION['tipo_agente'],'adicionar_tipos_ciclo')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar ciclo</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="outras_opcoes.php">Outras Opções</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="ciclos.php">Ciclos</a></font>
</div></div>

<div style="margin-top:80px; width:550px; min-height:100%;">
	<form id='adicionar_ciclos' action='adicionar_ciclos.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Adicionar tipo de ciclo</font></legend>
	<table>
				
				<input type='hidden' name='submitted'  id='submitted' value='1'/>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome' size="71"  maxlength="30" /></td><?php if(isset($_GET['erro']) && $_GET['erro']==1) { echo '<div style="color:red;">Introduza o nome do novo tipo de ciclo.</div>';} ?></tr>
				<tr><td><label for='descricao' >Descrição:</label></td>
				<td><textarea name='descricao' id='descricao' maxlength="150" rows=7 cols=54 ></textarea></td></tr>
	</table>
	<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de ciclo na criação de novos contratos)</div>
				</div>
	<br>
				<div align=right><input type="submit" name="form-submitted" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='ciclos.php'" value="Cancelar"></div>
	</form>
				<?php
				if(isset($_POST['form-submitted'])) {
				if($_POST['Nome']=="")
				{
					redirect('Adicionar_Ciclos.php?erro=1');
					exit;
				}		
				$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
					Adicionar_Tipos_Ciclo(htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$status);
					redirect('ciclos.php?success=true');
				}
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
