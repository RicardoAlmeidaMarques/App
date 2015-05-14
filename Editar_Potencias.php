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
	if(permissoes($_SESSION['tipo_agente'],'editar_condicoes_economicas')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar condições económicas</title>
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
<div style="margin-top: 100px; width:580px;">
	<form id='editar' action='editar_potencias.php' method='post' accept-charset='UTF-8'>
	<fieldset><legend><font size="4">Editar condição económica</font></legend>
	
				<select name="potencia" style="width:478px;float:left; margin-left:3px;">
				<?php
				$query=mysql_query("Select ID_Condicao, Valor_Potencia from condicoes_economicas order by ID_Condicao DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				if(isset($_GET['id']) && $dropdown['ID_Condicao']==$_GET['id'])
				{
					echo("<option selected value=". $dropdown["ID_Condicao"]. ">" . $dropdown["Valor_Potencia"] . ' kVA' . "</option>");
				}
					else
					{echo("<option value=". $dropdown["ID_Condicao"]. ">" . $dropdown["Valor_Potencia"] . ' kVA' . "</option>");
				}
				}
				
				?>
				</select>
				<div style="float:right;margin:-2px 5px 2px;"><input type="submit" name="form-submitted" value="Editar" /></Div>

				</form>
				
				<?php
				if(isset($_POST['form-submitted'])) {
					redirect('editar_potencias.php?id=' . $_POST["potencia"]);
				}
				
				?>
				<?php if(isset($_GET['id'])) { ?>		
			<div style="margin-top:50px; width:545px; min-height:100%;">
				<form id='editar_potencia' action="editar_potencias.php?id=<?php echo $_GET['id'];?>" method='post' accept-charset='UTF-8'>
				<table>
				
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
				<td><input class='right' type='text' name='potencia_left'  id='Nome' size="2"  maxlength="2"  value="<?php $id=$_GET['id'];$query=mysql_query("Select Valor_potencia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo intval($row['Valor_potencia']);?>" />,<input type='text' class='left' name='potencia_right' id='Nome' size="4"  maxlength="4" value="<?php $id=$_GET['id'];$query=mysql_query("Select Valor_potencia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo ($row['Valor_potencia']-intval($row['Valor_potencia']))*(pow(10,(strlen(substr(strstr($row['Valor_potencia'], "."), 1)))));?>"/> kVA</td><?php if(isset($_GET['erro'])) { echo '<div style="color:red;">Por favor preencha todos os campos.</div>';} ?></tr>
				<tr><td><label for='nome' >Termo Potência:</label></td>
				<td><input class='right' type='text' name='termo_potencia_left'  id='Nome' size="2"  maxlength="1" value="<?php $id=$_GET['id'];$query=mysql_query("Select Termo_potencia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo intval($row['Termo_potencia']);?>"/>,<input type='text' class='left' name='termo_potencia_right' id='Nome' size="4"  maxlength="4" value="<?php $id=$_GET['id'];$query=mysql_query("Select Termo_potencia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo ($row['Termo_potencia']-intval($row['Termo_potencia']))*(pow(10,(strlen(substr(strstr($row['Termo_potencia'], "."), 1)))));?>"/> €/Dia</td></tr>
				<tr><td><label for='nome' >Termo Energia:</label></td>
				<td><input class='right' type='text' name='termo_energia_left'  id='Nome' size="2"  maxlength="2" value="<?php $id=$_GET['id'];$query=mysql_query("Select Termo_energia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo intval($row['Termo_energia']);?>"/>,<input type='text' class='left' name='termo_energia_right' id='Nome' size="4"  maxlength="4" value="<?php $id=$_GET['id'];$query=mysql_query("Select Termo_energia from condicoes_economicas where ID_Condicao=$id");$row=mysql_fetch_assoc($query); echo ($row['Termo_energia']-intval($row['Termo_energia']))*(pow(10,(strlen(substr(strstr($row['Termo_energia'], "."), 1)))));?>"/> €/KWh</td></tr>
				</table>
				<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de potência na criação de novos contratos)</div>
				</div>
	
	<br>
				<div align=right><input type="submit" name="form-submitted2" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='condicoes_economicas.php'" value="Cancelar"></div>
	</form>
				<?php
				}
				if(isset($_POST['form-submitted2'])) {
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
					$Potencia=$_POST["potencia_left"] . '.' .  $_POST['potencia_right'];
					$Termo_Potencia=$_POST['termo_potencia_left'] . '.' .  $_POST['termo_potencia_right'];
					$Termo_Energia=$_POST['termo_energia_left'] . '.' .  $_POST['termo_energia_right'];
					if(!is_numeric($Potencia) || $Potencia==0)
					{
						redirect('editar_potencias.php?erro=1');
						exit;
					}
					if(!is_numeric($Termo_Potencia) || $Termo_Potencia==0)
					{
						redirect('editar_potencias.php?erro=2');
						exit;
					}
					if(!is_numeric($Termo_Energia) || $Termo_Energia==0)
					{
						redirect('editar_potencias.php?erro=3');
						exit;
					}
					$id=$_GET['id'];
					Editar_Condicoes_Economicas($id,$Potencia,$Termo_Potencia,$Termo_Energia,$status);
					redirect('condicoes_economicas.php?success=true');
				}
				
			?>

			
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
