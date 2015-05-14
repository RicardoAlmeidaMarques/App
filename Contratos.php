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
?>
<head>
<link rel="stylesheet" href="/Css/Index_Styles.css" type="text/css" media="screen"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<title>Contratos</title>
</head>
<div class="main_container">
<body>

<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
</div></div>
<div style="margin-top:85px;width:750px; min-height:100%; ">	
	<?php if ((permissoes($_SESSION['tipo_agente'],'criar_contratos')==1)) { ?>
	<BUTTON TYPE="submit" onClick="parent.location='adicionar_contrato.php'"><IMG SRC="/img/adicionar_contrato.png" ALIGN="absmiddle" ><br><br>Adicionar Contrato</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/adicionar_contrato_greyed.png" ALIGN="absmiddle" ><br><br>Adicionar Contrato</BUTTON>
	<?php } ?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_contratos')==1)) { ?>
	<BUTTON TYPE="submit" onClick="parent.location='editar_contratos.php?pag=1'"><IMG SRC="/img/editar_contrato.png" ALIGN="absmiddle" ><br><br>Editar Contratos</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/editar_contrato_greyed.png" ALIGN="absmiddle" ><br><br>Editar Contratos</BUTTON>
	<?php } ?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'criar_documentos')==1) or (permissoes($_SESSION['tipo_agente'],'criar_tipos_documentos')==1) or (permissoes($_SESSION['tipo_agente'],'editar_tipos_documentos')==1) ) {?>
	<BUTTON TYPE="submit" onClick="parent.location='documentos.php'"><IMG SRC="/img/documentos.png" ALIGN="absmiddle" ><br><br>Documentos</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/documentos_greyed.png" ALIGN="absmiddle" ><br><br>Documentos</BUTTON>
	<?php }
	
	?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_tipo_contagem')==1) or (permissoes($_SESSION['tipo_agente'],'adicionar_tipo_contagem')==1) or (permissoes($_SESSION['tipo_agente'],'efectuar_contagem')==1) 
	or (permissoes($_SESSION['tipo_agente'],'adicionar_condicoes_economicas')==1) or (permissoes($_SESSION['tipo_agente'],'editar_condicoes_economicas')==1) or(permissoes($_SESSION['tipo_agente'],'adicionar_tipos_ciclo')==1) 
	or (permissoes($_SESSION['tipo_agente'],'editar_tipos_ciclo')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='outras_opcoes.php'"><IMG SRC="/img/outras.png" ALIGN="absmiddle" ><br><br>Outras Opções</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/outras_greyed.png" ALIGN="absmiddle" ><br><br>Outras Opções</BUTTON>
	<?php } ?>
	

</div></div>
</body>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
<?php
require("/lib/success.php");
?>
</html>
