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
	if(permissoes($_SESSION['tipo_agente'],'criar_tipos_documentos')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Criar tipo de documento</title>
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
<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="documentos.php">Documentos</a></font>
</div></div>

<div style="margin-top:60px; width:600px; min-height:100%;">
<fieldset><legend><font size="4">Criar tipo de documento</font></legend>
	<form id='adicionar_tipo_Contagem' name='adicionar_tipo_Contagem' action='adicionar_tipo_documento.php' method='post' accept-charset='UTF-8'>
	
				
	<table>
				<center>
				<p>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='nome'  id='nome' size="45"  maxlength="40" /></td></tr>
	</table>
				<div align="left"><br><br><label for='enviar' >Enviar ao cliente</label>
				<input type="checkbox" name="checkbox[]" value="E" checked />
				<div style="margin-bottom:-5px;"></div>
				</div><div style="margin-bottom:-5px;"></div>
				<br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de contagem na criação de novos contratos)
				<br>
				
				
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
					Adicionar_Tipos_Documento(htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),$enviar,$status);
					redirect('documentos.php?success=true');
				}
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
