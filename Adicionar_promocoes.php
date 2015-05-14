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
	if(permissoes($_SESSION['tipo_agente'],'criar_documentos')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar Promoções</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<script language='javascript'>
				function verificar()
				{
					if (document.forms["adicionar_promocoes"]["nome"].value=="" || document.forms["adicionar_promocoes"]["nome"].value==null) {
					alert("Por favor introduza um nome para esta promoção.");
					}
					else if (document.forms["adicionar_promocoes"]["data_inicio_dia"].value=="" || document.forms["adicionar_promocoes"]["data_inicio_dia"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_inicio_dia"].value) ||
					document.forms["adicionar_promocoes"]["data_inicio_mes"].value=="" || document.forms["adicionar_promocoes"]["data_inicio_mes"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_inicio_mes"].value) ||
					document.forms["adicionar_promocoes"]["data_inicio_ano"].value=="" || document.forms["adicionar_promocoes"]["data_inicio_ano"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_inicio_ano"].value))
					{
					alert("Por favor introduza uma data de início válida.");
					}
					else if (document.forms["adicionar_promocoes"]["data_fim_dia"].value=="" || document.forms["adicionar_promocoes"]["data_fim_dia"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_fim_dia"].value) ||
					document.forms["adicionar_promocoes"]["data_fim_mes"].value=="" || document.forms["adicionar_promocoes"]["data_fim_mes"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_fim_mes"].value) ||
					document.forms["adicionar_promocoes"]["data_fim_ano"].value=="" || document.forms["adicionar_promocoes"]["data_fim_ano"].value==null || isNaN(document.forms["adicionar_promocoes"]["data_fim_ano"].value))
					{
					alert("Por favor introduza uma data de fim válida.");
					}
					else if (isNaN(document.forms["adicionar_promocoes"]["valor_left"].value))
					{
						alert("Por favor introduza um valor de desconto válido.");
					}
					else if (isNaN(document.forms["adicionar_promocoes"]["valor_right"].value))
					{
						alert("Por favor introduza um valor de desconto válido.");
					}
					else{ 
						document.forms["adicionar_promocoes"].submit();
					}
				}
				
				</script>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:-6px; float:left;"><BUTTON TYPE="submit" onClick="parent.location='index.php'"><IMG SRC="/img/home_button.png" ALIGN="absmiddle" ></BUTTON></div>
<div style="margin-top:-6px;float:left;"><BUTTON TYPE="submit" onClick="parent.location='promocoes.php'"><IMG SRC="/img/back_button.png" ALIGN="absmiddle" ></BUTTON></div>
</div>

<div style="margin:70px auto 70px auto;clear:both; width:423px; min-height:100%;">
<fieldset><legend><font size="4">Adicionar Promoções</font></legend>
	<form id='adicionar_promocoes' name='adicionar_promocoes' action='adicionar_promocoes.php' method='post' accept-charset='UTF-8'>
	
				
	<table>
				<center>
				<input type='hidden' name='submitted'  id='submitted' value='1'/>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='nome'  id='nome' size="45"  maxlength="40" /></td></tr>
				<tr><td><label for='descricao' >Descrição:</label></td>
				<td><textarea name='descricao' id='descricao' maxlength="150" rows=7 cols=34 ></textarea></td>
				<tr><td><label for='descricao' >Data de início:</label></td>
				<td><input type='text' name='data_inicio_dia' id='dia' size="2"  maxlength="2" />/<input type='text' name='data_inicio_mes' id='mes' size="2"  maxlength="2" />/<input type='text' name='data_inicio_ano' id='ano' size="4"  maxlength="4" />(dd / mm/ aaaa)</td></tr>
				<tr><td><label for='descricao' >Data de fim:</label></td>
				<td><input type='text' name='data_fim_dia' id='dia' size="2"  maxlength="2" />/<input type='text' name='data_fim_mes' id='mes' size="2"  maxlength="2" />/<input type='text' name='data_fim_ano' id='ano' size="4"  maxlength="4" />(dd / mm/ aaaa)</td></tr>
				
	</table>
				<div style="height:10px;"></div>
				<center>
				<input type='radio' name='tipo_de_promocao' id='tipo_de_promocao' value='percentagem' CHECKED>Percentagem
				<input type='radio' name='tipo_de_promocao' id='tipo_de_promocao' value='valor'>Valor
				 <style type="text/css">
				input.right{
				text-align:right;
				}
				input.left{
				text-align:left;
				}
				</style> 
				<br>
				<input class='right' type='text' name='valor_left'  id='valor_left' size="5"  maxlength="5" />,<input type='text' class='left' name='valor_right' id='Nome' size="3"  maxlength="3" /> % / €
				</center>
				<div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="checkbox[]" value="S" checked /><div style="font-size:13px;">(desactivar se pretende desactivar esta promoção)</div>
				</div>
				
	
	<br>
				<div align=right><input type="button" name="form-submitted" value="Confirmar" onclick="verificar()"/>
				<INPUT TYPE="button" onClick="parent.location='promocoes.php'" value="Cancelar"></div>
	</form>
	
				<?php
				if(isset($_POST['nome'])) {
					$checkbox=$_POST['checkbox'];
					if($checkbox[0]=='S'){
						$status=1;
					}else{ $status=0; }
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
					$data_inicio=date("Y-m-d",mktime(0,0,0,$_POST['data_inicio_mes'],$_POST['data_inicio_dia'],$_POST["data_inicio_ano"],-1));	
					$data_fim=date("Y-m-d",mktime(0,0,0,$_POST['data_fim_mes'],$_POST['data_fim_dia'],$_POST["data_fim_ano"],-1));
					if($_POST['tipo_de_promocao']=='valor')
					{
						Adicionar_promocoes(htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$data_inicio,$data_fim,$Valor,0,$status);
					}
					else
					{
						Adicionar_promocoes(htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8"),htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$data_inicio,$data_fim,0,$Valor,$status);
					}
					redirect('promocoes.php?success=true');
				}
	
				
				?>
				
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
