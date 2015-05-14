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
	if(permissoes($_SESSION['tipo_agente'],'Criar_documentos')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar ordem de emissão de documento</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<script language='javascript'>
				function verificar()
				{
					if (document.forms["adicionar_ordem_documento"]["contrato"].value=="" || document.forms["adicionar_ordem_documento"]["contrato"].value==null || isNaN(document.forms["adicionar_ordem_documento"]["contrato"].value))
					{
					alert("Por favor introduza um ID de contrato válido.");
					}
					else{ 
						document.forms["adicionar_ordem_documento"].submit();
					}
				}
				
				function verificar2()
				{
					if (document.forms["adicionar_documento"]["nome"].value=="" || document.forms["adicionar_documento"]["nome"].value==null) {
					alert("Por favor preencha o nome do tipo de documento.");
					}
					else if (isNaN(document.forms["adicionar_documento"]["valor_right"].value))
					{
					alert("Por favor introduza um valor correcto para a taxa.");
					}
					else if (isNaN(document.forms["adicionar_documento"]["valor_left"].value))
					{
					alert("Por favor introduza um valor correcto para a taxa.");
					}
					else{ 
						document.forms["adicionar_documento"].submit();
					}
				}
				
				</script>
<div class="main_container">
<body>
<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="documentos.php">Documentos</a></font>
</div></div>
<div style="margin-top:70px;width:580px; min-height:100%;">
	<form id='adicionar_ordem_documento' action='adicionar_ordem_documento.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Adicionar ordem de emissão de documento</font></legend>
				
				<select name="tipo_documento" style="width:570px;margin-left:0px; margin-top:5px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Documento, Nome_Tipo_Documento from tipo_documento WHERE STATUS=1 order by ID_Tipo_Documento DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				if(isset($_GET['id_tipo']) && $dropdown['ID_Tipo_Documento']==$_GET['id_tipo'])
				{
					echo("<option selected value=". $dropdown["ID_Tipo_Documento"]. ">" . $dropdown["Nome_Tipo_Documento"] . "</option>");
				}
					else
					{echo("<option value=". $dropdown["ID_Tipo_Documento"]. ">" . $dropdown["Nome_Tipo_Documento"] . "</option>");
				}
				}
				
				?>
				</select>
				<br>
				<div style="height:10px;"></div>
				<label for='contrato' >ID do Contrato:</label>
				<input type='text' name='contrato'  id='contrato' size="65"  maxlength="40" <?php if(isset($_GET['id_contrato'])){ echo 'Value="'.$_GET['id_contrato'].'"';} ?>/>
				<input type="button" value="Editar" onclick="verificar()"/>
	</form>
	
	<?php
	
		if(isset($_GET['id_tipo']))
		{
		
			?>
			<div style=" min-height:100%; ">
			<form id="adicionar_documento" name="adicionar_documento" action="adicionar_ordem_documento.php?id_tipo=<?php echo $_GET['id_tipo']?>&id_contrato=<?php echo $_GET['id_contrato']?>" method='post' accept-charset='UTF-8'>
			
			<?php
				$id_tipo=$_GET['id_tipo'];
				$id_contrato=$_GET['id_contrato'];
				if($_GET['id_tipo']!=0 && $_GET['id_tipo']!=-1)
				{
				$query=mysql_query("Select Nome_tipo_documento from tipo_documento where ID_Tipo_documento=$id_tipo");
				$row=mysql_fetch_Assoc($query);
				}
				$query2=mysql_query("Select Cliente.ID_Cliente, Nome_Cliente from cliente, contratos where Cliente.ID_Cliente=Contratos.ID_Cliente and ID_Contrato=$id_contrato");
				$row2=mysql_fetch_assoc($query2);
				?>
			
				<table>
					
						<tr><td><label for='nome_cliente'>Nome do cliente:</label></td>
						<td><input type='text' name='nome_cliente'  id='nome_cliente' size="45"  maxlength="40" value="<?php echo $row2['Nome_Cliente'];?>" DISABLED/></td></tr>
						<tr><td><label for='nome'>Nome:</label></td>
						<?php
						if($_GET['id_tipo']!=0 && $_GET['id_tipo']!=-1)
						{ ?>
						<td><input type='text' name='nome'  id='nome' size="45"  maxlength="40" value="<?php echo $row['Nome_tipo_documento'];?>"/></td></tr>
						<?php } else { ?>
						<td><input type='text' name='nome'  id='nome' size="45"  maxlength="40" /></td></tr>
						<?php } ?>
						<tr><td><label for='obs' >Observações:</label></td>
						<td><textarea name='obs' id='obs' maxlength="150" rows=7 cols=34 ></textarea></td></tr>
						<tr><td><label for='valor' >Valor a pagar:</label></td>
						<style type="text/css">
							input.right{
							text-align:right;
							}
							input.left{
							text-align:left;
							}
							</style> 
							<br>
							<td><input class='right' type='text' name='valor_left'  id='valor_left' size="5"  maxlength="5" />,<input type='text' class='left' name='valor_right' id='Nome' size="3"  maxlength="3" /> €</td>
				
						<tr><td colspan="2"><div style="font-size:13px;">No caso de este documento implicar uma taxa a ser paga pelo cliente, introduza aqui o valor.</div></td></tr>
						<br>
				</table>
				<div style="float:right;margin-top:5px; "><input type="button" value="Confirmar" onclick="verificar2()"/>
				<input type="button" value="Cancelar" onclick="parent.location='documentos.php'"/></div>
			
			</form>			
			
			<?php
		}
		
			if(isset($_POST['contrato'])) {
					$id_contrato=$_POST['contrato'];
					$query=mysql_query("Select ID_Contrato,Contratos.ID_Cliente as ID_Cliente_1,Cliente.ID_Cliente AS ID_Cliente_2, Nome_Cliente from contratos, cliente where Cliente.ID_Cliente=Contratos.ID_Cliente AND ID_Contrato=$id_contrato");
					if(mysql_num_rows($query)==0){
					?>
						<script type="text/javascript">
								alert("Contrato não existente.");
						</script>
					<?php
					}
					else
					{
					redirect('adicionar_ordem_documento.php?id_tipo=' . $_POST['tipo_documento'] . '&id_contrato=' . $_POST['contrato']);
					}
				}
								
								
								
			if(isset($_POST['valor_left']))
				{
					$valor_left=$_POST["valor_left"];
					$valor_right=$_POST["valor_right"];
					if($valor_left=="")
					{
						$valor_left=0;
					}
					if($valor_right=="")
					{
						$valor_right=0;
					}
					$Valor=$valor_left . '.' .  $valor_right;
					$id_tipo=$_GET['id_tipo'];
					$id_contrato=$_GET['id_contrato'];
					Criar_documentos($id_tipo,$id_contrato,htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['obs'], ENT_QUOTES, "UTF-8"),$Valor,NULL,0);
					redirect('documentos.php?success=true');
					
				}
				
			?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
