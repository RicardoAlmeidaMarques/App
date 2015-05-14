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
	if(permissoes($_SESSION['tipo_agente'],'adicionar_tipo_contagem')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar tipo de contagem</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<script language='javascript'>
				function verificar()
				{
					if (document.forms["adicionar_tipo_Contagem"]["nome"].value=="" || document.forms["adicionar_tipo_Contagem"]["nome"].value==null) {
					alert("Por favor preencha o nome do tipo de contagem.");
					}
					else if (document.forms["adicionar_tipo_Contagem"]["periodicidade"].value=="" || document.forms["adicionar_tipo_Contagem"]["periodicidade"].value==null || isNaN(document.forms["adicionar_tipo_Contagem"]["periodicidade"].value))
					{
					alert("Por favor introduza uma periodicidade válida.");
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
<font color=#288bcc size="3"> > </font><font size="5"><a href="outras_opcoes.php">Outras Opções</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contagens.php">Contagens</a></font>
</div></div>

<div style="margin-top:80px; width:580px; min-height:100%;">
<fieldset><legend><font size="4">Adicionar tipo de contagem</font></legend>
	<form id='adicionar_tipo_Contagem' name='adicionar_tipo_Contagem' action='adicionar_tipo_contagem.php' method='post' accept-charset='UTF-8'>
	
				
	<table>
				<center>
				<input type='hidden' name='submitted'  id='submitted' value='1'/>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='nome'  id='nome' size="64"  maxlength="40" /></td></tr>
				<tr><td><label for='descricao' >Descrição:</label></td>
				<td><textarea name='descricao' id='descricao' maxlength="150" rows=7 cols=48 ></textarea></td>
				<tr><td><label for='descricao' >Periodicidade (em dias):</label></td>
				<td><input type='text' name='periodicidade'  id='periodicidade' size="64"  maxlength="3" /></td></tr>
	</table>
				<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de contagem na criação de novos contratos)</div>
				</div>
	
	<br>
				<div align=right><input type="button" name="form-submitted" value="Confirmar" onclick="verificar()"/>
				<INPUT TYPE="button" onClick="parent.location='contagens.php'" value="Cancelar"></div>
	</form>
				<?php
				if(isset($_POST['nome'])) {
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
					$periodicidade=$_POST['periodicidade'];
					Adicionar_Tipo_Contagem(htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$periodicidade,$status);
					redirect('contagens.php?success=true');
				}
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
