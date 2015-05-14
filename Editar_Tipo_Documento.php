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
	if(permissoes($_SESSION['tipo_agente'],'editar_tipos_documentos')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar tipo de documento</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<script language='javascript'>
				function verificar()
				{
					if (document.forms["adicionar_tipo_Contagem"]["nome"].value=="" || document.forms["adicionar_tipo_Contagem"]["nome"].value==null) {
					alert("Por favor preencha o nome do tipo de documento.");
					}
					else{ 
						document.forms["adicionar_tipo_Contagem"].submit();
					}
				}
				
				</script>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="documentos.php">Documentos</a></font>
</div></div>
<div style="margin-top:75px; width:600px; min-height:100%;">
<form id='editar' action='editar_tipo_documento.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Editar tipo de documento</font></legend>
	<center><table>
				<select name="tipo_documento" style="width:500px;float:left; margin-left:3px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Documento, Nome_Tipo_Documento from tipo_documento order by ID_Tipo_Documento DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				if(isset($_GET['id']) && $dropdown['ID_Tipo_Documento']==$_GET['id'])
				{
					echo("<option selected value=". $dropdown["ID_Tipo_Documento"]. ">" . $dropdown["Nome_Tipo_Documento"] . "</option>");
				}
					else
					{echo("<option value=". $dropdown["ID_Tipo_Documento"]. ">" . $dropdown["Nome_Tipo_Documento"] . "</option>");
				}
				}
				
				?>
				</select>
				<div style="float:right;margin:-2px 13px 0px 2px; "><input type="submit" name="form-submitted" value="Editar" /></Div>
				</table>
				</form>
				
				<?php
				if(isset($_POST['form-submitted'])) {
					redirect('editar_tipo_documento.php?id=' . $_POST["tipo_documento"]);
				}
				
				if(isset($_GET['id']))
				{
				$id=$_GET['id'];
				$query=mysql_query("Select Nome_tipo_Documento,enviar_cliente,status from tipo_documento where ID_tipo_documento=$id");
				$row=mysql_fetch_assoc($query);
				?>
				<div style="margin-top:50px;width:550px; min-height:100%; ">
				<form id='adicionar_tipo_Contagem' name='adicionar_tipo_Contagem' action='editar_tipo_documento.php?id=<?php echo $_GET['id'];?>' method='post' accept-charset='UTF-8'>
					
								
				
								
								<input type='hidden' name='submitted'  id='submitted' value='1'/>
								<div align="left"><label for='nome' >Nome:</label>
								<input type='text' name='nome'  id='nome' size="45"  maxlength="40" value="<?php echo $row['Nome_tipo_Documento'];?>"/>
								<br><br><label for='enviar' >Enviar ao cliente</label>
								<input type="checkbox" name="checkbox[]" value="E" <?php if($row['enviar_cliente']==1){ echo 'checked';}?> />
								<div style="margin-bottom:-5px;"></div>
								</div><div style="margin-bottom:-5px;"></div>
								<div style="text-align:left">
								<br><label for='status' >Status</label>
								<input type="checkbox" name="checkbox[]" value="S" <?php if($row['status']==1){ echo 'checked';}?> /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de contagem na criação de novos contratos)
								<br>
								</div>
								
								</div>
					
					<br>
								<div align=right><input type="button" name="form-submitted" value="Confirmar" onclick="verificar()"/>
								<INPUT TYPE="button" onClick="parent.location='documentos.php'" value="Cancelar"></div>
					</form>
								<?php
								if(isset($_POST['nome'])) {
									$checkbox=$_POST['checkbox'];
									if($checkbox[0]=='S' || $checkbox[1]=='S'){
										$status=1;
									}else{ $status=0; }
									if($checkbox[0]=='E' || $checkbox[1]=='E'){
										$enviar=1;
									}else{ $enviar=0; }
									Editar_Tipos_Documento($id,htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),$enviar,$status);
									redirect('documentos.php?success=true');
								}
								
								}
								
								?>
</div></div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
