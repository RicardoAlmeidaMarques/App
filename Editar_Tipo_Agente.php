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
	if(permissoes($_SESSION['id'],'editar_tipo_agente')==0)
	{
		redirect('index.php');
	}
?>
<head>
<title>Editar Tipo Agente</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
</head>
<div class="main_container">
<body>
<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="agentes.php">Agentes</a></font>
</div></div>
<div style="margin: 70px auto 0px; clear:both; width:750px;">
	<form id='editar' action='editar_tipo_agente.php' method='post' accept-charset='UTF-8'>
	<fieldset>
				<legend><font size="4">Editar tipo de agente</font></legend>
	<center><table>
				<select name="tipo_agente" style="width:655px;float:left; margin-left:3px;">
				<?php
				$query=mysql_query("Select ID_Tipo_Agente, Nome_Tipo from Tipo_Agente order by ID_Tipo_Agente DESC");
				while ( $dropdown = mysql_fetch_array($query) ){
				if(isset($_GET['id']) && $dropdown['ID_Tipo_Agente']==$_GET['id'])
				{
					echo("<option selected value=". $dropdown["ID_Tipo_Agente"]. ">" . $dropdown["Nome_Tipo"] . "</option>");
				}
					else
					{echo("<option value=". $dropdown["ID_Tipo_Agente"]. ">" . $dropdown["Nome_Tipo"] . "</option>");
				}
				}
				
				?>
				</select>
				<div style="float:right;margin:-2px 5px 2px;"><input type="submit" name="form-submitted" value="Editar" /></Div>
				</table>
				</form>
				
				
	<?php if(isset($_GET['id'])) { ?>
	<div style="clear:both;margin-top:50px;"></div>
	<form id='editar_tipo' action='editar_tipo_agente.php?id= <?php echo $_GET['id'];?>' method='post' accept-charset='UTF-8'>			
				<?php if(isset($_GET['erro']) && $_GET['erro']==1) { echo '<div style="color:red;">Introduza um nome para este tipo de agente.</div>';} ?>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<table>
				<tr><td><label for='nome' >Nome:</label></td>
				<td><input type='text' name='Nome' id='Nome'  maxlength="100" size=<?php if(isset($_GET['error']) && $_GET['error']==1){echo '43';} else {echo '74';}?> value="<?php $id=$_GET['id'];$query=mysql_query("Select NOME_TIPO from Tipo_agente where ID_Tipo_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['NOME_TIPO'];?>"/></td></tr>
				<?php if(isset($_GET['error']) && $_GET['error']==1) { echo '<div style=" font-size:10;color:red; position:absolute; margin:3px 0px 0px 370px;">Por favor introduza um nome</div>'; } ?>
				<tr><td><label for='Descrição' >Descrição:</label></td>
				<td><textarea name='descricao' id='descricao' maxlength="150" rows=2 cols=56 ><?php $id=$_GET['id'];$query=mysql_query("Select Descricao from Tipo_agente where ID_Tipo_Agente=$id");$row=mysql_fetch_assoc($query); echo $row['Descricao'];?></textarea></td></tr></table>
				<table>
				<br>
				<b>Permissões</b><br><br>
				<?php $id=$_GET['id'];$query=mysql_query("Select * from Tipo_agente where ID_Tipo_Agente=$id");$row=mysql_fetch_assoc($query);?>
				<tr><td><label for='adicionar_cliente' >Adicionar Cliente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="A" <?php if ($row['ADICIONAR_CLIENTE']==1) { echo 'checked';} ?>/></td>
				<td><label for='editar_cliente' >Editar Cliente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="B" <?php if ($row['EDITAR_CLIENTE']==1) { echo 'checked';} ?>/></td></tr>
				<tr><td><label for='adicionar_tipo_contagem' >Adicionar tipo de contagem</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="C"  <?php if ($row['ADICIONAR_TIPO_CONTAGEM']==1) { echo 'checked';} ?> /></td>
				<td><label for='editar_tipo_contagem' >Editar tipo de contagem</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="D" <?php if ($row['EDITAR_TIPO_CONTAGEM']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td><label for='adicionar_agente' >Adicionar agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="E"  <?php if ($row['ADICIONAR_AGENTE']==1) { echo 'checked';} ?>   /></td>
				<td><label for='editar_agente' >Editar Agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="F"   <?php if ($row['EDITAR_AGENTE']==1) { echo 'checked';} ?>  /></td></tr>
				<tr><td><label for='adicionar_tipo_agente' >Adicionar tipo de Agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="G"  <?php if ($row['ADICIONAR_TIPO_AGENTE']==1) { echo 'checked';} ?>   /></td>
				<td><label for='editar_tipo_agente' >Editar tipo de agente</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="H"  <?php if ($row['EDITAR_TIPO_AGENTE']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td><label for='adicionar_tipos_ciclo' >Adicionar tipos de ciclo</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="I"  <?php if ($row['ADICIONAR_TIPOS_CICLO']==1) { echo 'checked';} ?>  /></td>
				<td><label for='editar_tipos_ciclo' >Editar tipos de ciclo</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="J"  <?php if ($row['EDITAR_TIPOS_CICLO']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td><label for='adicionar_condicoes_economicas' >Adicionar condições económicas</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="K"  <?php if ($row['ADICIONAR_CONDICOES_ECONOMICAS']==1) { echo 'checked';} ?> /></td>
				<td><label for='editar_condicoes_economicas' >Editar condições económicas</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="L"  <?php if ($row['EDITAR_CONDICOES_ECONOMICAS']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td><label for='criar_contratos' >Criar contratos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="M"  <?php if ($row['CRIAR_CONTRATOS']==1) { echo 'checked';} ?> /></td>
				<td><label for='editar_contratos' >Editar contratos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="N"  <?php if ($row['EDITAR_CONTRATOS']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td><label for='criar_documentos' >Criar ordens de emissão de documentos</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="O"   <?php if ($row['CRIAR_DOCUMENTOS']==1) { echo 'checked';} ?>/></td>
				<td><label for='editar_documentos' >Verificar ordens de emissão de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="P"   <?php if ($row['EDITAR_DOCUMENTOS']==1) { echo 'checked';} ?>/></td></tr>
				<tr><td><label for='criar_tipos_documentos' >Criar tipos de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="Q"   <?php if ($row['CRIAR_TIPOS_DOCUMENTOS']==1) { echo 'checked';} ?> /></td>
				<td><label for='editar_tipos_documentos' >Editar tipos de documento</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="R"   <?php if ($row['EDITAR_TIPOS_DOCUMENTOS']==1) { echo 'checked';} ?> /></td></tr></center>
				<tr><td><label for='efectuar_contagens' >Efectuar contagens</label></td>
				<td><input type="checkbox" name="Checkbox[]" value="S"   <?php if ($row['EFECTUAR_CONTAGEM']==1) { echo 'checked';} ?> /></td></tr>
				<tr><td colspan=4><div align="left"><br><label for='status' >Status</label>
				<input type="checkbox" name="Checkbox[]" value="T"  <?php if ($row['STATUS']==1) { echo 'checked';} ?> /><div style="font-size:13px;">(desactivar se não pretende utilizar este tipo de utilizador na criação de novos agentes)</div>
				</div>
				</table>
	<br>
				<div align=right><input type="submit" name="form-submitted2" value="Guardar" />
				<INPUT TYPE="button" onClick="parent.location='agentes.php'" value="Cancelar"></div>
				</form>
				<?php } ?>
				
				<?php
				
				if(isset($_POST['form-submitted'])) {
					redirect('editar_tipo_agente.php?id=' . $_POST["tipo_agente"]);
				}
				
				if(isset($_POST['form-submitted2'])) {
					if(!isset($_POST['Nome']) || $_POST['Nome']==NULL)
					{ redirect('editar_tipo_agente.php?id='.$_GET["id"] .'&error=1'); exit; }
					for($z=0; $z<21; $z++)
					{
						$array[$z]=0;
					}
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
								if(isset($checkbox[$x]) && $checkbox[$x]==$i)
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
					$id=$_GET['id'];
					if($_POST['Nome']=="")
					{
						redirect('editar_tipo_agente.php?id='. $_GET["ID"] . 'erro=1');
						exit;
					}
					Editar_Tipos_Agente($id,htmlentities($_POST['Nome'], ENT_QUOTES, "UTF-8"), htmlentities($_POST['descricao'], ENT_QUOTES, "UTF-8"),$array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],
					$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
					
					redirect('agentes.php?success=true');
				}
				?>
</div></div></div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>

</html>
