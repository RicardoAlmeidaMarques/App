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
	if(permissoes($_SESSION['tipo_agente'],'criar_contratos')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar Contrato</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>

	<script language='javascript'>
				function verificar()
				{
					if (document.forms["Adicionar"]["nome_via"].value=="" || document.forms["Adicionar"]["nome_via"].value==null) {
					alert("Por favor introduza um nome de via válido.");
					}
					else if (document.forms["Adicionar"]["tipo_via"].value=="" || document.forms["Adicionar"]["tipo_via"].value==null) {
					alert("Por favor introduza um tipo de via válido.");
					}
					else if (document.forms["Adicionar"]["codigo_postal"].value=="" || document.forms["Adicionar"]["codigo_postal"].value==null) {
					alert("Por favor preencha o código postal do cliente.");
					}
					else if (document.forms["Adicionar"]["localidade_cliente"].value=="" || document.forms["Adicionar"]["localidade_cliente"].value==null) {
					alert("Por favor preencha a localidade do cliente.");
					}
					else if (document.forms["Adicionar"]["CPE"].value=="" || document.forms["Adicionar"]["CPE"].value==null) {
					alert("Por favor introduza um CPE válido.");
					}
					else if (document.forms["Adicionar"]["Localidade_contrato"].value=="" || document.forms["Adicionar"]["Localidade_contrato"].value==null) {
					alert("Por favor introduza uma localidade de efectivação do contrato válida.");
					}
					else if (document.forms["Adicionar"]["data_contrato_dia"].value=="" || document.forms["Adicionar"]["data_contrato_dia"].value==null || isNaN(document.forms["Adicionar"]["data_contrato_dia"].value) ||
					document.forms["Adicionar"]["data_contrato_mes"].value=="" || document.forms["Adicionar"]["data_contrato_mes"].value==null || isNaN(document.forms["Adicionar"]["data_contrato_mes"].value) ||
					document.forms["Adicionar"]["data_contrato_ano"].value=="" || document.forms["Adicionar"]["data_contrato_ano"].value==null || isNaN(document.forms["Adicionar"]["data_contrato_ano"].value))
					{
					alert("Por favor introduza uma data de contrato válida.");
					}
					
					else if (document.forms["Adicionar"]["Agente"].value=="" || document.forms["Adicionar"]["Agente"].value==null || isNaN(document.forms["Adicionar"]["Agente"].value)) {
					alert("Por favor introduza um ID de agente válido.");
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
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
</div></div>
<div style="margin-top:65px; width:750px; min-height:100%;">
	<fieldset> <legend><font size="4">Adicionar Contrato</font></legend>
	<?php 
	if(!isset($_GET['id']))
	{
	?>
	<form id="criar" action="adicionar_contrato.php" method='post' accept-charset='UTF-8'>
	<tr><td><label for='nome' >Criar um contrato para o cliente com o ID:</label></td>
	<td><input type='text' name='id' id='id' size="10"  maxlength="10" /></td>
	<input type="submit" name="form-submitted" value="Confirmar" />
	</form>
	<?php 
	}
	else{
	$id=$_GET['id'];
	if(!isset($_GET['checked']))
	{
	?>
	
	<form id="criar" action="adicionar_contrato.php?id=<?php echo $_GET['id'];?>" method='post' accept-charset='UTF-8'>
	<table><tr><td>Cliente</td> <td><input type='text' name='id' id='id' size="108"  maxlength="74" value='<?php $query=mysql_query("Select Nome_Cliente from Cliente where ID_Cliente=$id"); $row=mysql_fetch_assoc($query); echo $row['Nome_Cliente']; ?>' DISABLED /></td></tr>
	<tr><td>BI</td> <td><input type='text' name='id' id='id' size="108"  maxlength="74" value='<?php $query=mysql_query("Select BI from Cliente where ID_Cliente=$id"); $row=mysql_fetch_assoc($query); echo $row['BI']; ?>' DISABLED /></td></tr>
	</table>
	<input type="submit" name="form-submitted2" value="Confirmar" />
	<input type="button" value="Voltar" onclick="parent.location='adicionar_contrato.php'"/>
	</form>
	<?php
	}
	else
	{ ?>
	<table><tr><td>Cliente</td> <td><input type='text' name='id' id='id' size="108"  maxlength="74" value='<?php $query=mysql_query("Select Nome_Cliente from Cliente where ID_Cliente=$id"); $row=mysql_fetch_assoc($query); echo $row['Nome_Cliente']; ?>' DISABLED /></td></tr>
	<tr><td>BI</td> <td><input type='text' name='id' id='id' size="108"  maxlength="74" value='<?php $query=mysql_query("Select BI from Cliente where ID_Cliente=$id"); $row=mysql_fetch_assoc($query); echo $row['BI']; ?>' DISABLED /></td></tr>
	</table>
	<?php 
	}
	}
	if(isset($_POST['form-submitted']))
	{
		if($_POST['id']=='' || !is_numeric($_POST['id']))
		{
			echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">alert ("Introduza um ID válido.")</script>';
		}
		else
		{
			redirect('adicionar_contrato.php?id=' . $_POST["id"]);
		}
	}
	if(isset($_POST['form-submitted2']))
	{
		redirect('adicionar_contrato.php?id=' . $_GET['id'] . '&checked=yes');
	}
	if(isset($_GET['checked']))
	{
	?>
	<br>
	<form id="Adicionar" action="adicionar_contrato.php?id=<?php echo $_GET['id'] ?>&checked=yes" method='POST' accept-charset='UTF-8'>
	<fieldset>
	<legend><font size="3">Ponto de fornecimento</font></legend>
	<label for='Telefone' >Nome da via:</label>
	<td><input type='text' name='nome_via' size="88"  maxlength="50" /></td></tr>
	<br>
		<div style="height:10px;"></div>
		<label for='Telefone' >Tipo de via:</label>
		<input type='text' name='tipo_via' size="4"  maxlength="4" />
		<label for='Telefone' >Número da porta:</label>
		<input type='text' name='numero_porta' size="5"  maxlength="5" />
		<label for='Telefone' >Piso:</label>
		<input type='text' name='piso' size="2"  maxlength="2" />
		<label for='Telefone' >Lado:</label>
		<input type='text' name='lado' size="9"  maxlength="9" />
		<label for='Telefone' >Habitação:</label>
		<input type='text' name='habitacao' size="6"  maxlength="6" />
		<div style="height:10px;"></div>
		<table>
		<tr><td><label for='Código_Postal' >Código Postal:</label></td>
		<td><input type='text' name='codigo_postal' id='codigo_postal' size="8"  maxlength="8" /></td>
		<td><label for='Telefone' >Localidade:</label></td>
		<td><input type='text' name='localidade_cliente' size="39"  maxlength="15" /></td></tr>
		</table>
	</fieldset>
	
	<div style="height:10px;"></div>
	<fieldset>
	
	<legend><font size="3">Dados do ponto de fornecimento</font></legend>
		<label for='CPE' >CPE:</label>
		<input type='text' name='CPE' size="20"  maxlength="20" />
		<label for='CPE' >Consumo (kWh/ano):</label>
		<input type='text' name='Consumo' size="6"  maxlength="6" />
		<label for='Contagem' >Contagem:</label>
		<select name="Contagem" style="width:182px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Contagem, Nome_Contagem from Tipo_Contagem Where Status=1 order by ID_Tipo_Contagem DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				echo("<option value=". $dropdown["ID_Tipo_Contagem"]. ">" . $dropdown["Nome_Contagem"] . "</option>");
				}
				
				?>
		</select>
		<div style="height:10px;"></div>
		<label for='Ciclo' >Ciclo:</label>
		<select name="Ciclo" style="width:146px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Ciclo, Nome_Ciclo from Tipos_Ciclo Where Status=1 order by ID_Tipo_Ciclo DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				echo("<option value=". $dropdown["ID_Tipo_Ciclo"]. ">" . $dropdown["Nome_Ciclo"] . "</option>");
				}
				
				?>
		</select>
		<label for='Ciclo' >Pot. Contratada:</label>
		<select name="Pot_contratada" style="width:96px;">
				<?php
				$query=mysql_query("Select ID_Condicao, Valor_Potencia from Condicoes_economicas Where Status=1 order by Valor_Potencia");
				while ( $dropdown = mysql_fetch_array($query) ){
				echo("<option value=". $dropdown["ID_Condicao"]. ">" . $dropdown["Valor_Potencia"] . " kVA</option>");
				}
				
				?>
		</select>
		<label for='OBJ'> Obj. Ligação/NIP: </label>
		<input type='text' name='objecto_ligacao' size="17"  maxlength="17" />
		<div style="height:10px;"></div>
		<label for='OBJ'> Ref. Contrato Anterior: </label>
		<input type='text' name='ref_anterior' size="18"  maxlength="18" />
		<div style="text-align:right; float:right;"><label for='Fases'> Fases recepção: </label>
		<input type="radio" name="fases" value="M"> Monofásico
		<input type="radio" name="fases" value="T" checked> Trifásico</div>
		<div style="height:10px;"></div>
		<label for='numero'> Nº Processo / Pedido: </label>
		<input type='text' name='Numero_Processo' size="19"  maxlength="14" />
	</fieldset>
		<div style="height:10px;"></div>
	<fieldset>
	<legend><font size="3">Facturação e condições de pagamento</font></legend>
	<table>
	<tr><td><label for='numero'> Factura electrónica </label></td>
	<td><input type='checkbox' name="Factura_electronica" value="S" /></td>
	<td><input type='text' name='email' size="74"  maxlength="50" value="Introduza aqui o email." onfocus="value=''"/></td></tr>
	<div style="height:10px;"></div>
	<tr><td><label for='numero'> Domiciliação Bancária  </label></td>
	<td><input type='checkbox' name="Domiciliacao_bancaria" value="S" checked /></td>
	<td><input type='text' name='IBAN' size="74"  maxlength="25" value="Introduza aqui o IBAN." onfocus="value=''"/></td></tr></table>
	</fieldset>
	<div style="height:10px;"></div>
	<div align="right">Assinado em <input type='text' name='Localidade_contrato' size="20"  maxlength="20" />, <input type='text' name='data_contrato_dia' id='dia' size="2"  maxlength="2" />/<input type='text' name='data_contrato_mes' id='mes' size="2"  maxlength="2" />/<input type='text' name='data_contrato_ano' id='ano' size="4"  maxlength="4" />(dd / mm/ aaaa)</div>
	<div style="height:10px;"></div>
	<div align="right">ID do Agente responsável <input type='text' name='Agente' size="20"  maxlength="20" />
	<div style="height:10px;"></div>	
	<div align="right"><input type="button" name="form-submitted3" value="Confirmar" onclick="verificar()"/>
	<input type="button" value="Voltar" onclick="parent.location='adicionar_contrato.php'"/></div>
	
	</form>
	<?php
	if(isset($_POST['nome_via']))
	{
		if($_POST['numero_porta']=='')
		{
			$Numero_porta=NULL;
		}
		else{	$Numero_porta=$_POST['numero_porta']; }
		if($_POST['lado']=='')
		{
			$lado=NULL;
		}
		else{	$lado=$_POST['lado']; }
		if($_POST['piso']=='')
		{
			$Piso=NULL;
		}
		else{	$Piso=$_POST['piso']; }
		if($_POST['habitacao']=='')
		{
			$habitacao=NULL;
		}
		else{	$habitacao=$_POST['habitacao']; }
		if($_POST['Consumo']=='')
		{
			$Consumo=NULL;
		}
		else{	$Consumo=$_POST['Consumo']; }
		if(!isset($_POST['objecto_ligacao']) || $_POST['objecto_ligacao']=='')
		{
			$Objecto_ligacao=NULL;
		}
		else{	$Objecto_ligacao=$_POST['objecto_ligacao']; }
		if($_POST['ref_anterior']=='')
		{
			$Ref_anterior=NULL;
		}
		else{	$Ref_anterior=$_POST['ref_anterior']; }
		if(!isset($_POST['Numero_Processo']) || $_POST['Numero_Processo']=='')
		{
			$Num_Processo=NULL;
		}
		else{	$Num_Processo=$_POST['Numero_Processo']; }
		if(isset($_POST['Factura_electronica']) && $_POST['Factura_electronica']=='S')
		{
			$Factura_electronica=1;
		}
		else{	$Factura_electronica=0; }
		if(isset($_POST['Domiciliacao_bancaria']) && $_POST['Domiciliacao_bancaria']=='S')
		{
			$Domiciliacao_bancaria=1;
		}
		else{	$Domiciliacao_bancaria=0; }
		$data_contrato=date("Y-m-d",mktime(0,0,0,$_POST['data_contrato_mes'],$_POST['data_contrato_dia'],$_POST["data_contrato_ano"],-1));		
		if($Domiciliacao_bancaria==0)
		{$IBAN=NULL;}
		else{$IBAN=$_POST['IBAN'];}
		if($Factura_electronica==0)
		{$email=NULL;}
		else{$email=$_POST['email'];}
		Criar_Contratos($id,$_POST['Contagem'],$_POST['Ciclo'],$_POST['Agente'],$_POST['Pot_contratada'],$data_contrato,htmlentities($_POST['Localidade_contrato'], ENT_QUOTES, "UTF-8")
		,$Factura_electronica,$email,$Domiciliacao_bancaria,$IBAN,$_POST['CPE'],$Consumo,NULL,0,
		$Ref_anterior,$_POST['fases'],$Num_Processo,$Objecto_ligacao,htmlentities($_POST['tipo_via'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['nome_via'], ENT_QUOTES, "UTF-8"),$Numero_porta,
						$Piso,htmlentities($_POST['lado'], ENT_QUOTES, "UTF-8"),$habitacao,$_POST['codigo_postal'],htmlentities($_POST['localidade_cliente'], ENT_QUOTES, "UTF-8"),1);
			
		redirect('contratos.php?success=true');
	}
	
	}
	
	?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
