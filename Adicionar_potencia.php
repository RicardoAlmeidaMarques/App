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
	if(permissoes($_SESSION['tipo_agente'],'adicionar_condicoes_economicas')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar condições</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="outras_opcoes.php">Outras Opções</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="condicoes_economicas.php">Condições económicas</a></font>
</div></div>

<div style="margin-top:100px; width:550px; min-height:100%;">
<fieldset><legend><font size="4">Adicionar condição económica</font></legend>
	<form id='adicionar_potencia' action='adicionar_potencia.php' method='post' accept-charset='UTF-8'>
	
				
	<table>
				<center>
				<input type='hidden' name='submitted'  id='submitted' value='1'/>
				<tr><td><label for='nome' >Potência:</label></td>
				 <style type="text/css">
				input.right{
				text-align:right;
				}
				input.left{
				text-align:left;
				}
				</style> 
				<br>
				<td><input class='right' type='text' name='potencia_left'  id='Nome' size="2"  maxlength="2" />,<input type='text' class='left' name='potencia_right' id='Nome' size="4"  maxlength="4" /> kVA</td><?php if(isset($_GET['erro'])) { echo '<div style="color:red;">Por favor preencha todos os campos.</div>';} ?></tr>
				<tr><td><label for='nome' >Termo Potência:</label></td>
				<td><input class='right' type='text' name='termo_potencia_left'  id='Nome' size="2"  maxlength="1" />,<input type='text' class='left' name='termo_potencia_right' id='Nome' size="4"  maxlength="4" /> €/Dia</td></tr>
				<tr><td><label for='nome' >Termo Energia:</label></td>
				<td><input class='right' type='text' name='termo_energia_left'  id='Nome' size="2"  maxlength="2" />,<input type='text' class='left' name='termo_energia_right' id='Nome' size="4"  maxlength="4" /> €/KWh</td></tr>
				</table>
				<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de potência na criação de novos contratos)</div>
				</div>
	
	<br>
				<div align=right><input type="submit" name="form-submitted" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='condicoes_economicas.php'" value="Cancelar"></div>
	</form>
				<?php
				if(isset($_POST['form-submitted'])) {
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
					$Potencia=$_POST["potencia_left"] . '.' .  $_POST['potencia_right'];
					$Termo_Potencia=$_POST['termo_potencia_left'] . '.' .  $_POST['termo_potencia_right'];
					$Termo_Energia=$_POST['termo_energia_left'] . '.' .  $_POST['termo_energia_right'];
					if(!is_numeric($Potencia) || $Potencia==0)
					{
						redirect('adicionar_potencia.php?erro=1');
						exit;
					}
					if(!is_numeric($Termo_Potencia) || $Termo_Potencia==0)
					{
						redirect('adicionar_potencia.php?erro=2');
						exit;
					}
					if(!is_numeric($Termo_Energia) || $Termo_Energia==0)
					{
						redirect('adicionar_potencia.php?erro=3');
						exit;
					}
					Adicionar_Condicoes_Economicas($Potencia,$Termo_Potencia,$Termo_Energia,$status);
					redirect('condicoes_economicas.php?success=true');
				}
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
