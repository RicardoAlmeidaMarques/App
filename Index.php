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
	else{
		$_SESSION['tipo_agente']=tipo_agente($_SESSION['id']);
		}
?>
<head>
<link rel="stylesheet" href="/Css/Index_Styles.css" type="text/css" />
<title>GestC</title>
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5" color="red"><a href="index.php">Home</a></font></div></div>
<div class="menu">
<div style="margin-top:100px;width:750px; min-height:100%; ">	
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_agente')==1) or (permissoes($_SESSION['tipo_agente'],'adicionar_agente')==1) or (permissoes($_SESSION['tipo_agente'],'adicionar_tipo_agente')==1) or (permissoes($_SESSION['tipo_agente'],'editar_tipo_agente')==1)) { ?>
	<BUTTON TYPE="submit" onClick="parent.location='agentes.php'"><IMG SRC="/img/agentes.png" ALIGN="absmiddle" ><br><br>Agentes</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/agentes_greyed.png" ALIGN="absmiddle" ><br><br>Agentes</BUTTON>
	<?php } ?>
	
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_cliente')==1) or (permissoes($_SESSION['tipo_agente'],'adicionar_cliente')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='clientes.php'"><IMG SRC="/img/clientes.png" ALIGN="absmiddle" ><br><br>Clientes</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/clientes_greyed.png" ALIGN="absmiddle" ><br><br>Clientes</BUTTON>
	<?php } ?>
	
	
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_tipos_ciclo')==1) or (permissoes($_SESSION['tipo_agente'],'editar_tipos_ciclo')==1) or (permissoes($_SESSION['tipo_agente'],'criar_contratos')==1)
	or (permissoes($_SESSION['tipo_agente'],'editar_contratos')==1) or (permissoes($_SESSION['tipo_agente'],'efectuar_contagem')==1) or (permissoes($_SESSION['tipo_agente'],'adicionar_tipo_contagem')==1) or (permissoes($_SESSION['tipo_agente'],'editar_tipo_contagem')==1) 
	or (permissoes($_SESSION['tipo_agente'],'adicionar_condicoes_economicas')==1) or (permissoes($_SESSION['tipo_agente'],'editar_condicoes_economicas')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='contratos.php'"><IMG SRC="/img/contratos.png" ALIGN="absmiddle" ><br>Contratos e outras<br> opções</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/contratos_greyed.png" ALIGN="absmiddle" ><br>Contratos e outras<br> opções</BUTTON>
	<?php } ?>
	
	<?php if (permissoes($_SESSION['tipo_agente'],'efectuar_contagem')==1) {?>
	<BUTTON TYPE="submit" onClick="parent.location='ordens_contagem.php?pag=1'"><IMG SRC="/img/contagens.png" ALIGN="absmiddle" ><br><br> Efectuar contagens</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/contagens.png" ALIGN="absmiddle" ><br><br> Efectuar contagens</BUTTON>
	<?php } ?>
	
	</div>

</div>

</div>

</div>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>


</html>
