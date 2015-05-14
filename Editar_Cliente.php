<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<?php
require("/lib/init.php");
?>

<?php
	if(!isset($_SESSION['id']))
	{
		redirect('login.php');
		
	}
	if(permissoes($_SESSION['tipo_agente'],'editar_cliente')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar Cliente</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>

	<script language='javascript'>
				function verificar()
				{
					if (document.forms["Adicionar"]["Nome"].value=="" || document.forms["Adicionar"]["Nome"].value==null) {
					alert("Por favor preencha o nome do cliente.");
					}
					else if (document.forms["Adicionar"]["Contribuinte"].value=="" || document.forms["Adicionar"]["Contribuinte"].value==null || isNaN(document.forms["Adicionar"]["Contribuinte"].value)) {
					alert("Por favor introduza um número de contribuinte válido.");
					}
					else if (document.forms["Adicionar"]["CAE"].value=="" || document.forms["Adicionar"]["CAE"].value==null) {
					alert("Por favor preencha o CAE do cliente.");
					}
					else if (document.forms["Adicionar"]["BI"].value=="" || document.forms["Adicionar"]["BI"].value==null) {
					alert("Por favor preencha o BI do cliente.");
					}
					else if (document.forms["Adicionar"]["data_nascimento_dia"].value=="" || document.forms["Adicionar"]["data_nascimento_dia"].value==null || isNaN(document.forms["Adicionar"]["data_nascimento_dia"].value) ||
					document.forms["Adicionar"]["data_nascimento_mes"].value=="" || document.forms["Adicionar"]["data_nascimento_mes"].value==null || isNaN(document.forms["Adicionar"]["data_nascimento_mes"].value) ||
					document.forms["Adicionar"]["data_nascimento_ano"].value=="" || document.forms["Adicionar"]["data_nascimento_ano"].value==null || isNaN(document.forms["Adicionar"]["data_nascimento_ano"].value))
					{
					alert("Por favor introduza uma data de nascimento válida.");
					}
					else if (document.forms["Adicionar"]["nome_via"].value=="" || document.forms["Adicionar"]["nome_via"].value==null) {
					alert("Por favor preencha o nome da via do cliente.");
					}
					else if (document.forms["Adicionar"]["tipo_via"].value=="" || document.forms["Adicionar"]["tipo_via"].value==null) {
					alert("Por favor preencha o tipo de via do cliente.");
					}
					else if (document.forms["Adicionar"]["codigo_postal"].value=="" || document.forms["Adicionar"]["codigo_postal"].value==null) {
					alert("Por favor preencha o código postal do cliente.");
					}
					else if (document.forms["Adicionar"]["localidade_cliente"].value=="" || document.forms["Adicionar"]["localidade_cliente"].value==null) {
					alert("Por favor preencha a localidade do cliente.");
					}
					else{ 
						document.forms["Adicionar"].submit();
					}
				}
				
				</script>
				
<div class="main_container">
<body>


<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="clientes.php">Clientes</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="editar_clientes.php?pag=1">Editar clientes</a></font>
</div></div>

<div style="margin-top:65px; width:750px;">
	<form id='Adicionar' action='editar_cliente.php?id=<?php echo $_GET['id']; ?>' method='post' accept-charset='UTF-8' name='Adicionar'>
	<fieldset> <legend><font size="4">Editar Cliente</font></legend>
	<?php 
	$id=$_GET['id'];
	$query=mysql_query("Select *, DAY(DATA_NASCIMENTO) AS DAY, MONTH(DATA_NASCIMENTO) AS MONTH, YEAR(DATA_NASCIMENTO) AS YEAR from Cliente where ID_cliente=$id");
	$row=mysql_fetch_assoc($query);
	?>
	<table>
				
				<input type='hidden' name='submitted' size="39" id='submitted' value='1'/>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome' size="60"  maxlength="100" value='<?php echo $row['NOME_CLIENTE'];?>' /></td>
				<td><label for='nome' >Nº de contribuinte:</label></td>
				<td><input type='text' name='Contribuinte' id='Contribuinte' size="23"  maxlength="9" value=<?php echo $row['CONTRIBUINTE'];?> /></td></tr>
				<td><label for='nome' >Contacto:</label></td>
				<td><input type='text' name='Contacto' id='Contacto' size="60"  maxlength="50" value='<?php echo $row['CONTACTO'];?>' /></td>
				<td><label for='nome' >CAE:</label></td>
				<td><input type='text' name='CAE' id='CAE' size="23"  maxlength="5" value=<?php echo $row['CAE'];?> /></td></tr>
				<tr><td></td><td></td><td><label for='nome' >BI / CC:</label></td>
				<td><input type='text' name='BI' id='BI' size="23"  maxlength="8" value=<?php echo $row['BI'];?> /></td></tr>
				</table>			
				<br>
				<label for='Telefone' >Telefone 1:</label>
				<input type='text' name='Telefone' id='Telefone' size="9"  maxlength="9" value=<?php echo $row['TELEFONE_1'];?> />
				<label for='Telefone' >Telefone 2:</label>
				<input type='text' name='Telefone_2' id='Telefone2' size="9"  maxlength="9" value=<?php echo $row['TELEFONE_2'];?> />
				<label for='Telefone' >Fax:</label>
				<input type='text' name='Fax' id='Fax' size="9"  maxlength="9" value=<?php echo $row['FAX'];?> />
				<div style="height:5px;"></div>
	<table>		
				
				<tr><td><label for='data_de_nascimento' >Data de nascimento:</label></td></div>
				<td><input type='text' name='data_nascimento_dia' id='dia' size="2"  maxlength="2" value=<?php echo $row['DAY'];?> />/<input type='text' name='data_nascimento_mes' id='mes' size="2"  maxlength="2" value=<?php echo $row['MONTH'];?> />/<input type='text' name='data_nascimento_ano' id='ano' size="4"  maxlength="4" value=<?php echo $row['YEAR'];?> />(dd / mm/ aaaa)</td></tr>
				
				
				<tr><td><label for='Telefone' >Tipo de utilização:</label></td>
				<td><input type="radio" name="tipo" value="D" <?php if($row['TIPO_UTILIZACAO']=='D'){ echo 'checked';} ?>> Doméstica
				<input type="radio" name="tipo" value="N" <?php if($row['TIPO_UTILIZACAO']=='N'){ echo 'checked';} ?>> Não doméstica</td></tr>
	</table>

	<br>
	<fieldset> <legend><font size="3">Correspondência</font></legend>
				<tr><td><label for='Telefone' >Nome da via:</label></td>
				<td><input type='text' name='nome_via' size="88"  maxlength="50" value='<?php echo $row['NOME_VIA'];?>' /></td></tr>
				<br>
				<div style="height:10px;"></div>
				<tr><td><label for='Telefone' >Tipo de via:</label>
				<input type='text' name='tipo_via' size="4"  maxlength="4" value='<?php echo $row['TIPO_VIA'];?>' /></td>
				<td><label for='Telefone' >Número da porta:</label>
				<input type='text' name='numero_porta' size="5"  maxlength="5" value='<?php echo $row['NUMERO_PORTA'];?>' /></td>
				<td><label for='Telefone' >Piso:</label>
				<input type='text' name='piso' size="2"  maxlength="2" value='<?php echo $row['PISO'];?>' /></td>
				<td><label for='Telefone' >Lado:</label>
				<input type='text' name='lado' size="9"  maxlength="9" value='<?php echo $row['LADO'];?>' /></td></tr>
				<tr><td><label for='Telefone' >Habitação:</label></td>
				<td><input type='text' name='habitacao' size="6"  maxlength="6" value='<?php echo $row['HABITACAO'];?>' /></td></tr>
				<div style="height:10px;"></div>
				<table>
				<tr><td><label for='Código_Postal' >Código Postal:</label></td>
				<td><input type='text' name='codigo_postal' id='codigo_postal' size="8"  maxlength="8" value=<?php echo $row['CODIGO_POSTAL'];?> /></td>
				<td><label for='Telefone' >Localidade:</label></td>
				<td><input type='text' name='localidade_cliente' size="39"  maxlength="15" value=<?php echo $row['LOCALIDADE_CLIENTE'];?> /></td></tr>
	
	</table>
	</fieldset>
	<div align="left"><br><br><label for='status' >Necessidades especiais</label>
				<input type="checkbox" name="checkbox[]" value="N" <?php if($row['NECESSIDADES_ESPECIAIS']==1){ echo 'checked';} ?>/>
				<label for='status' >Prioritário</label>
				<input type="checkbox" name="checkbox[]" value="P" <?php if($row['PRIORITARIO']==1){ echo 'checked';} ?>/>
				</div>
				<br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="O" <?php if($row['STATUS']==1){ echo 'checked';} ?>/>
	<br>
				<div align=right><input type="button" name="form-submitted" value="Confirmar" onclick="verificar()"/>
				<INPUT TYPE="button" onClick="parent.location='editar_clientes.php?pag=1'" value="Cancelar"></div>
	</form>
	
			
			<?php
				
				if(isset($_POST['Nome']))
				{
					if($_POST['Telefone']=="")
					{	
						$_POST['Telefone']=0;
					}
					if($_POST['Telefone_2']=="")
					{
						$_POST['Telefone_2']=0;
					}	
					if($_POST['Contacto']=="")
					{
						$_POST['Contacto']='';
					}	
					if($_POST['Fax']=="")
					{
						$_POST['Fax']=0;
					}
					if($_POST['numero_porta']=="")
					{
						$_POST['numero_porta']='';
					}
					if($_POST['piso']=="")
					{
						$_POST['piso']='';
					}
					if($_POST['lado']=="")
					{
						$_POST['lado']='';
					}
					if($_POST['habitacao']=="")
					{
						$_POST['habitacao']='';
					}
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='N')
					{ $Necessidades_especiais=1;}
					else
					{ $Necessidades_especiais=0;}
					if($checkbox[0]=='P' || (Isset($checkbox[1]) && $checkbox[1]=='P'))
					{ $Prioritario=1; }
					else
					{ $Prioritario=0; }
					if($checkbox[0]=='O' || (Isset($checkbox[1]) && $checkbox[1]=='O') || (Isset($checkbox[2]) && $checkbox[2]=='O'))
					{ $status=1; }
					else
					{ $status=0; }
					$data_nascimento=date("Y-m-d",mktime(0,0,0,$_POST['data_nascimento_mes'],$_POST['data_nascimento_dia'],$_POST["data_nascimento_ano"],-1));
					$id=$_GET['id'];
					Editar_Cliente($id,htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"),$_POST['Contribuinte'],$_POST['CAE'],$Necessidades_especiais,$Prioritario,htmlentities($_POST['Contacto'], ENT_QUOTES, "UTF-8"),$_POST['Telefone'],$_POST['Telefone_2'],$data_nascimento,$_POST['Fax'],$_POST['tipo'],
							$_POST['tipo_via'],htmlentities($_POST['nome_via'], ENT_QUOTES, "UTF-8"),$_POST['numero_porta'],$_POST['piso'],$_POST['lado'],$_POST['habitacao'],$_POST['codigo_postal'],htmlentities($_POST['localidade_cliente'], ENT_QUOTES, "UTF-8"),$_POST['BI'],$status);
					redirect('editar_clientes.php?pag=1&success=true');
				}
				
					
					
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
