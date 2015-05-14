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
	if(permissoes($_SESSION['tipo_agente'],'editar_tipo_contagem')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar tipo de contagem</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<script language='javascript'>
				function verificar()
				{
					if (document.forms["editar_tipo_Contagem"]["nome"].value=="" || document.forms["editar_tipo_Contagem"]["nome"].value==null) {
					alert("Por favor preencha o nome do tipo de contagem.");
					}
					else if (document.forms["editar_tipo_Contagem"]["periodicidade"].value=="" || document.forms["editar_tipo_Contagem"]["periodicidade"].value==null || isNaN(document.forms["editar_tipo_Contagem"]["periodicidade"].value))
					{
					alert("Por favor introduza uma periodicidade válida.");
					}
					else{ 
						document.forms["editar_tipo_Contagem"].submit();
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
<div style="margin-top: 80px; width:580px;">
	<form id='editar' action='editar_tipo_contagem.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Editar tipo de contagem</font></legend>
				<select name="contagem" style="width:478px;float:left; margin-left:3px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Contagem, Nome_Contagem from Tipo_contagem order by ID_Tipo_Contagem DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				if(isset($_GET['id']) && $dropdown['ID_Tipo_Contagem']==$_GET['id'])
				{
					echo("<option selected value=". $dropdown["ID_Tipo_Contagem"]. ">" . $dropdown["Nome_Contagem"] . "</option>");
				}
					else
					{echo("<option value=". $dropdown["ID_Tipo_Contagem"]. ">" . $dropdown["Nome_Contagem"] . "</option>");
				}
				}
				
				?>
				</select>
				<div style="float:right;margin:-2px 5px 2px;"><input type="submit" name="form-submitted" value="Editar" /></Div>
				</form>
				
				<?php
				if(isset($_POST['form-submitted'])) {
					redirect('editar_tipo_Contagem.php?id=' . $_POST["contagem"]);
				}
				
				?>
				<?php if(isset($_GET['id'])) {
				$id=$_GET['id'];
				$query=mysql_query("Select Nome_contagem, Descricao_contagem, periodicidade, status from tipo_contagem where id_tipo_contagem=$id");
				$row=mysql_fetch_Assoc($query);
				?>		
				<div style="margin-top:50px; width:550px; min-height:100%;">
				<form id='editar_tipo_Contagem' name='editar_tipo_Contagem' action='editar_tipo_contagem.php?id=<?php echo $_GET["id"];?>' method='post' accept-charset='UTF-8'>
	
				
				<table>
		
						<input type='hidden' name='submitted'  id='submitted' value='1'/>
						<tr><td><label for='nome' >Nome:</label></td>
						<td><input type='text' name='nome'  id='nome' size="62"  maxlength="40" value="<?php echo $row['Nome_contagem']; ?>"/></td></tr>
						<tr><td><label for='descricao' >Descrição:</label></td>
						<td><textarea name='descricao' id='descricao' maxlength="150" rows=7 cols=47 ><?php echo $row['Descricao_contagem']; ?></textarea></td>
						<tr><td><label for='descricao' >Periodicidade (em dias):</label></td>
						<td><input type='text' name='periodicidade'  id='periodicidade' size="62"  maxlength="3" value="<?php echo $row['periodicidade']; ?>" /></td></tr>
				</table>
				<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de contagem na criação de novos contratos)</div>
				</div>
	
	<br>
				<div align=right><input type="button" name="form-submitted2" value="Confirmar" onclick="verificar()"/>
				<INPUT TYPE="button" onClick="parent.location='contagens.php'" value="Cancelar"></div>
	</form>
				<?php
				if(isset($_POST['nome'])) {
				$id=$_GET['id'];
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
				    Editar_Tipo_Contagem($id,htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$_POST['periodicidade'],$status);
				    redirect('contagens.php?success=true');
				}
				
				}
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
