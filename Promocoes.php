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
<title>Promoções</title>
</head>
<div class="main_container">
<body>
<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5" color="red"><a href="index.php">Home</a></font></div></div>
<div style="margin:100px auto; clear:both; width:620px; min-height:100%; ">	
	<center>
	<?php if ((permissoes($_SESSION['tipo_agente'],'CRIAR_DOCUMENTOS')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='adicionar_promocoes.php'"><IMG SRC="/img/adicionar_promocoes.png" ALIGN="absmiddle" ><br><br>Adicionar Promoções</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/adicionar_promocoes_greyed.png" ALIGN="absmiddle" ><br><br>Adicionar Promocoes</BUTTON>
	<?php } ?>
	<?php if ((permissoes($_SESSION['tipo_agente'],'EDITAR_DOCUMENTOS')==1)) {?>
	<BUTTON TYPE="submit" onClick="parent.location='editar_promocoes.php'"><IMG SRC="/img/editar_promocoes.png" ALIGN="absmiddle" ><br><br>Editar Promoções</BUTTON>
	<?php } else { ?>
	<BUTTON TYPE="submit" disabled><IMG SRC="/img/editar_promocoes_greyed.png" ALIGN="absmiddle" ><br><br>Editar Promoções</BUTTON>
	<?php } ?>

	
	</center>
</div></div>
</body>
<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
<?php
require("/lib/success.php");
?>
</html>
