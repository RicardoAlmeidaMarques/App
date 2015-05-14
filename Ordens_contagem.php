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
	if(permissoes($_SESSION['tipo_agente'],'efectuar_contagem')==0)
	{
		redirect('index.php');
	}
	 Actualizar_contagens();
?>
<head>
<title>Ordens de contagem</title>
<link rel="stylesheet" href="/Css/Editar_Agentes_Styles.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
<div class="main_container">

<div style="height:85px;position: relative; min-width:100%; margin-top:20px;"><img src="/img/banner.png" /><div style="position:absolute; margin:-70px 0px 0px 460px; color:black; width:290px;text-align:right;">Bem vindo, <?php echo $_SESSION['Nome']; ?> <div style="margin-top:-5px;text-align:right;font-size:20px;"><a href="logout.php">Logout</a></div></div>
<div style="margin-top:15px;"><font size="5"><a href="index.php">Home</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contratos.php">Contratos</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="outras_opcoes.php">Outras Opções</a></font>
<font color=#288bcc size="3"> > </font><font size="5"><a href="contagens.php">Contagens</a></font>
</div></div>
<div style="position:relative; float:Right; width:235px;margin-top:20px">
<form id='pesquisa' action="ordens_contagem.php<?php if(isset($_GET['pag'])){ echo '?pag='. $_GET['pag'];} ?>" method='post' accept-charset='UTF-8'>
<input type='text' name='Nome' id='Nome'  maxlength="70" Value="Id do contrato."  onFocus="this.value=''"/><input type="submit" name="pesquisa" value="Pesquisar" />
</form>
</div>

<?php
if(isset($_POST['pesquisa']))
{
	if (is_numeric($_POST['Nome']))
	{
		redirect('ordens_contagem.php?id_contrato='.$_POST['Nome']);
	}
	else
	{
		?> <script type="text/javascript">alert("Insira o número do contrato do qual quer consultar as contagens.")</script> <?php
	}
}
					
					
?>
				
<div class="menu">
<div style="height:20px;">
</div>
<?php
echo '<center>';
if(isset($_GET['id_contrato'])){
	echo '<div style="margin:10px auto; clear:both; min-width:20px;">';
	Mostrar_contagem($_SESSION['id'],$_GET['id_contrato']);
	echo '</div>';
	
	}

?>

<div style="clear:both;">

<?php

if(isset($_GET['pag']))
{

Mostrar_Contagens($_GET['pag'],$_SESSION['id']);
echo '</center></div><br>';
echo '<div style="margin:10px auto 60px auto; float:right; min-width:20px;">';
$pag = ($_GET['pag']);
$inicio = 0;
$limite = 1;
if ($pag!='')
{
	$inicio = ($pag - 1) * $limite;
}

$busca_total = mysql_query("SELECT COUNT(*)/10 as total FROM Contagens");
$total = mysql_fetch_array($busca_total);
$total = $total['total'];
$prox = $pag + 1;
$ant = $pag - 1;
$ultima_pag = ceil($total / $limite);
$penultima = $ultima_pag - 1;  
$adjacentes = 2;
if ($pag>1)
{
  $paginacao = '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;border:1px solid #808080;"><a href="ordens_contagem.php?pag='.$ant.'">« anterior</a></div>';
}
else{$paginacao = '';}
if ($ultima_pag <= 5)
{
  for ($i=1; $i< $ultima_pag+1; $i++)
	{
	if ($i == $pag)
	{
		$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';        

    }else {
		$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';  
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
				$paginacao .= '<div style="border:1px solid #808080;padding:2px; margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';        
			} else 
			{
				$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';  
			}
	}
	$paginacao .= '<div style="padding:2px;margin:1px; float:left;">...</div>';
	$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$penultima.'">'.$penultima.'</a></div>';
	$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="ordens_contagem.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a></div>';
}
elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3)
{
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="ordens_contagem.php?pag=1">1</a></div>';        
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;margin:1px;float:left;"><a href="ordens_contagem.php?pag=1">2</a></div><div style="padding:2px;margin:1px;float:left;"> ... </div>';  
for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++)
{
if ($i == $pag)
{
 $paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';        
} else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';  
}
}
$paginacao .= '<div style="padding:2px;margin:1px;float:left;">...</div>';
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;float:left;"><a href="ordens_contagem.php?pag='.$penultima.'">'.$penultima.'</a></div>';
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a></div>';
}
else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag=1">1</a></div>';        
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px;  float:left;"><a href="ordens_contagem.php?pag=1">2</a></div> <div style="padding:2px;margin:1px; float:left;">... </div>';  
for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++)
 {
 if ($i == $pag)
{
  $paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left; font-size:20px; margin-top:-3px;font-weight:bold;"><a class="atual" href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';        
} else {
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$i.'">'.$i.'</a></div>';  
 }
 }
}
}
if ($prox <= $ultima_pag && $ultima_pag > 1)
{
$paginacao .= '<div style="border:1px solid #808080;padding:2px;margin:1px; float:left;"><a href="ordens_contagem.php?pag='.$prox.'">pr&oacute;xima &raquo;</a></div>';
}
echo $paginacao;
}
?>
</div>


</div></div>


<div style="height:60px; width:762px ;bottom:0; margin:auto;"><img src="/img/footer.png" /></div>
</body>
<script type="text/javascript">
function show_prompt(id_contrato,id_contagem)
{
var consumo=prompt("Consumo");
if (consumo!=null && consumo!="")
  {
  window.location = 'efectuar_contagem.php?id=' + id_contrato + '&id_contagem=' + id_contagem + '&consumo=' + consumo;
  }
}
</script>
<?php
require("/lib/success.php");
?>

</html>

