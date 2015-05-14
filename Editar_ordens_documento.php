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
	if(permissoes($_SESSION['tipo_agente'],'editar_documentos')==0)
	{
		redirect('index.php');
	}
	if(!isset($_GET['pag']) && !isset($_GET['id']))
	{
		redirect('editar_ordens_documento.php?pag=1');
	}
?>
<head>
<title>Ver ordens de emissão de documento</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>
</head>
<body onload="JavaScript:timedRefresh(10000);">
<div class="main_container">

<div style="height:100px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="documentos.php">Documentos</a></font>
</div></div>
<div style="position:relative; float:Right; width:385px;margin-top:5px">
<form id='pesquisa' action='editar_ordens_documento.php' method='post' accept-charset='UTF-8'>
<input type='text' name='Nome' id='Nome'  maxlength="70" size="45" value="Introduza o ID do documento."  onFocus="this.value=''"/><input type="submit" name="pesquisa" value="Pesquisar" />
</form>
</div>

<?php
if(isset($_POST['pesquisa']))
{
	if (is_numeric($_POST['Nome']))
	{
		redirect('editar_ordens_documento.php?id='.$_POST['Nome']);
	}
}
					
					
?>
				
<div class="menu">
<?php
echo '<center>';
if(isset($_GET['id'])){
	echo '<div style="margin:60px auto; clear:both; min-width:20px;">';
	Mostrar_ordem_Documento($_GET['id']);
	echo '</div>';
	
	}
?>

<div style="clear:both;margin-top:60px;">

<?php

if(isset($_GET['pag']))
{

Mostrar_ordens_documento($_GET['pag'],$_SESSION['id']);
echo '</center></div><br>';
echo '<div style="margin:0px auto 60px auto; float:right; min-width:20px;">';
$pag = ($_GET['pag']);
$inicio = 0;
$limite = 1;
if ($pag!='')
{
	$inicio = ($pag - 1) * $limite;
}

$busca_total = mysql_query("SELECT COUNT(*)/10 as total FROM documentos");
$total = mysql_fetch_array($busca_total);
$total = $total['total'];
$prox = $pag + 1;
$ant = $pag - 1;
$ultima_pag = ceil($total / $limite);
$penultima = $ultima_pag - 1;  
$adjacentes = 2;
if ($pag>1)
{
  $paginacao = '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;border:1px solid #808080;"><a href="editar_ordens_documento.php?pag='.$ant.'">« anterior</a></div>';
}
else{$paginacao = '';}
if ($ultima_pag <= 5)
{
  for ($i=1; $i< $ultima_pag+1; $i++)
	{
	if ($i == $pag)
	{
		$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';        

    }else {
		$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';  
		}
	}
}
if ($ultima_pag > 5)
{
	if ($pag < 1 + (2 * $adjacentes))
	{
		for ($i=1; $i< 2 + (2 * $adjacentes); $i++)
		{
			if ($i == $pag)
			{
				$paginacao .= '<div style="border:1px solid #808080;padding:2px; margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';        
			} else 
			{
				$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';  
			}
	}
	$paginacao .= '<div style="padding:2px;margin:1px; float:left;">...</div>';
	$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$penultima.'">'.$penultima.'</a></div>';
	$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="editar_ordens_documento.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a></div>';
}
elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3)
{
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="editar_ordens_documento.php?pag=1">1</a></div>';        
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;margin:1px;float:left;"><a href="editar_ordens_documento.php?pag=1">2</a></div><div style="padding:2px;margin:1px;float:left;"> ... </div>';  
for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++)
{
if ($i == $pag)
{
 $paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';        
} else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';  
}
}
$paginacao .= '<div style="padding:2px;margin:1px;float:left;">...</div>';
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="editar_ordens_documento.php?pag='.$penultima.'">'.$penultima.'</a></div>';
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a></div>';
}
else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag=1">1</a></div>';        
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;  float:left;"><a href="editar_ordens_documento.php?pag=1">2</a></div> <div style="padding:2px;margin:1px; float:left;">... </div>';  
for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++)
 {
 if ($i == $pag)
{
  $paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';        
} else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$i.'">'.$i.'</a></div>';  
 }
 }
}
}
if ($prox <= $ultima_pag && $ultima_pag > 1)
{
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="editar_ordens_documento.php?pag='.$prox.'">pr&oacute;xima &raquo;</a></div>';
}
echo $paginacao;
}
?>
</div>


</div></div>


<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>
<script type="text/javascript">
				// Popup window code
				function newPopup(id_contrato,id_documento) {
				var url="ver_dados.php?id_contrato=" + id_contrato + "&id_documento=" + id_documento;
				popupWindow = window.open(
				url,'popUpWindow',"height=580,width=500,left=200,top=200,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes")
				}
				
				function newPopup2(id_contrato,id_documento) {
				var url="ver_dados_nao_enviar.php?id_contrato=" + id_contrato + "&id_documento=" + id_documento;
				popupWindow = window.open(
				url,'popUpWindow',"height=580,width=500,left=200,top=200,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes")
				}
</script>
<?php
require("/lib/success.php");
?>

</html>

