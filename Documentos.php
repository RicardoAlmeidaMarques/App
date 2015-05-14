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
<link rel="stylesheet" href="/Css/Index_Styles.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<title>Documentos</title>
</head>
<div class="main_container">
<body>
<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="documentos.php">Documentos</a></font>
</div></div>
<div style="margin-top:85px;width:750px; min-height:100%; ">	
	<?php if ((permissoes($_SESSION['tipo_agente'],'criar_documentos')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='adicionar_ordem_documento.php'"><IMG SRC="/img/adicionar_ordem_documento.png" ALIGN="absmiddle" ><br>Criar ordem<br>de emissão<br>de documento</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/adicionar_ordem_documento_greyed.png" ALIGN="absmiddle" ><br>Criar ordem<br>de emissão<br>de documento</BUTTON>
	<?php } ?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_documentos')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='editar_ordens_documento.php?pag=1'"><IMG SRC="/img/editar_ordem_documento.png" ALIGN="absmiddle" ><br>Ver ordens<br>de emissão<br>de documento</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/editar_ordem_documento_greyed.png" ALIGN="absmiddle" ><br>Ver ordens<br>de emissão<br>de documento</BUTTON>
	<?php } ?>
	
	<?php if ((permissoes($_SESSION['tipo_agente'],'criar_tipos_documentos')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='adicionar_tipo_documento.php'"><IMG SRC="/img/adicionar_tipo_documento.png" ALIGN="absmiddle" ><br><br>Criar tipo<br>de documento</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/adicionar_tipo_documento_greyed.png" ALIGN="absmiddle" ><br><br>Criar tipo<br>de documento</BUTTON>
	<?php } ?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'editar_tipos_documentos')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='editar_tipo_documento.php'"><IMG SRC="/img/editar_tipo_documento.png" ALIGN="absmiddle" ><br><br>Editar tipo<br>de documento</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/editar_tipo_documento_greyed.png" ALIGN="absmiddle" ><br><br>Editar tipo<br>de documento</BUTTON>
	<?php } ?>
</div></div>
</body>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
<?php
require("/lib/success.php");
?>
</html>
