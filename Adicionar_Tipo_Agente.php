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
	if(permissoes($_SESSION['tipo_agente'],'adicionar_tipo_agente')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Adicionar Tipo Agente</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>

<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="agentes.php">Agentes</a></font>
</div></div>
<div style="margin-top:70px; width:750px;">
	<form id='editar' action='adicionar_tipo_agente.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Adicionar tipo de agente</font></legend>
	<center><table>
				<?php if(isset($_GET['erro']) && $_GET['erro']==1) { echo '<div style="color:red;">Introduza um nome para este tipo de agente.</div>';} ?>
			
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome'  maxlength="100" size=74/></td></tr>
				<tr><td><label for='Descrição' >Descrição:</label></td>
				<td><textarea name='descricao' id='descricao' maxlength="150" rows=2 cols=56 ></textarea></td></tr></table>
				<table>
				<br>
				
				<b>Permissões</b><br><br>
				<tr><td><label for='adicionar_cliente' >Adicionar Cliente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="A" /></td>
				<td><label for='editar_cliente' >Editar Cliente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="B" /></td></tr>
				<tr><td><label for='adicionar_tipo_contagem' >Adicionar tipo de contagem</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="C"  /></td>
				<td><label for='editar_tipo_contagem' >Editar tipo de contagem</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="D"    /></td></tr>
				<tr><td><label for='adicionar_agente' >Adicionar agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="E"    /></td>
				<td><label for='editar_agente' >Editar Agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="F"    /></td></tr>
				<tr><td><label for='adicionar_tipo_agente' >Adicionar tipo de Agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="G"    /></td>
				<td><label for='editar_tipo_agente' >Editar tipo de agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="H"  /></td></tr>
				<tr><td><label for='adicionar_tipos_ciclo' >Adicionar tipos de ciclo</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="I"   /></td>
				<td><label for='editar_tipos_ciclo' >Editar tipos de ciclo</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="J"  /></td></tr>
				<tr><td><label for='adicionar_condicoes_economicas' >Adicionar condições económicas</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="K"  /></td>
				<td><label for='editar_condicoes_economicas' >Editar condições económicas</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="L"  /></td></tr>
				<tr><td><label for='criar_contratos' >Criar contratos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="M"  /></td>
				<td><label for='editar_contratos' >Editar contratos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="N"   /></td></tr>
				<tr><td><label for='criar_documentos' >Criar ordens de emissão de documentos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="O"  /></td>
				<td><label for='editar_documentos' >Verificar ordens de emissão de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="P"  /></td></tr>
				<tr><td><label for='criar_tipos_documentos' >Criar tipos de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="Q"   /></td>
				<td><label for='editar_tipos_documentos' >Editar tipos de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="R"   /></td></center>
				<tr><td><label for='efectuar_contagens' >Efectuar contagens</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="T"   /></td></tr>
				<tr><td colspan="4"><div align="left"><br><br><label for='status' >Status</label>
				<input type="checkbox" name="Checkbox[]" value="S"  /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de utilizador na criação de novos agentes)</div>
				</table>

				
	<br>
	<br>
				<div align=right><input type="submit" name="form-submitted" value="Confirmar" />
				<INPUT TYPE="button" onClick="parent.location='agentes.php'" value="Cancelar"></div>
				</form>
				<?php
				if(isset($_POST['form-submitted'])) {
					$checkbox=$_POST['Checkbox'];
					if(empty($checkbox))
					{
						for($i=0; $i<20; $i++)
						{
						$array[$i]=0;
						}
					}
					else
					{
						$n=0;
						for($i='A'; $i<'U'; $i++)
						{
							for($x=0; $x<=$n+1 ; $x++)
							{
								if($checkbox[$x]==$i)
								{
									$array[$n]=1;
								}
								if($x>=$n && $array[$n]!=1)
								{
									$array[$n]=0;
								}
							}
							$n=$n+1;
						}
					
					}
					if($_POST['Nome']=="")
					{
						redirect('adicionar_tipo_agente.php?erro=1');
						exit;
					}
					Adicionar_Tipo_Agente(htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],
					$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[19],$array[18]);
					
					redirect('agentes.php?success=true');
				 }
				
				
				
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>

</html>
