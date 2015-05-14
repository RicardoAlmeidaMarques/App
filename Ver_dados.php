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
?>
<head>

<title>Dados do cliente</title>

<?php
	$id_contrato=$_GET['id_contrato'];
	$id_documento=$_GET['id_documento'];
	$query2=mysql_query("Select Factura_electronica,email,domiciliacao_bancaria,IBAN,contratos.nome_via as nome_via,contratos.tipo_via as tipo_via,contratos.numero_porta as numero_porta,contratos.piso as piso,contratos.lado as lado,contratos.habitacao as habitacao,contratos.codigo_postal as codigo_postal,contratos.id_cliente as id_cliente,cliente.Nome_cliente as nome_cliente , contratos.localidade_ponto_fornecimento as localidade from contratos,cliente where contratos.id_contrato=$id_contrato and contratos.id_cliente=cliente.id_cliente");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	$row2=mysql_fetch_assoc($query2);
	$factura_electronica=$row2['Factura_electronica'];
	$email=$row2['email'];
	$domiciliacao_bancaria=$row2['domiciliacao_bancaria'];
	$iban=$row2['IBAN'];
	$nome_via=$row2['nome_via'];
	$tipo_via=$row2['tipo_via'];
	$numero_porta=$row2['numero_porta'];
	$piso=$row2['piso'];
	$lado=$row2['lado'];
	$habitacao=$row2['habitacao'];
	$codigo_postal=$row2['codigo_postal'];
	$localidade=$row2['localidade'];
	$nome_cliente=$row2['nome_cliente'];
	$id_cliente=$row2['id_cliente'];
	
?>
<div style="width:490px;">
<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>
<center>
<table>
<tr><td class=datacellone>ID do contrato</td> <td class=datacellone><?php echo $id_contrato ?></td></tr>
<tr><td class=datacelltwo>ID do documento</td> <td class=datacelltwo><?php echo $id_documento ?></td></tr>
<tr><td class=datacellone>Factura electrónica</td> <td class=datacellone><?php if($factura_electronica==1){echo 'Sim';} else{ echo 'Não';} ?></td></tr>
<tr><td class=datacelltwo>E-mail</td> <td class=datacelltwo><?php echo $email ?></td></tr>
<tr><td class=datacellone>Domiciliação Bancária</td> <td class=datacellone><?php if($domiciliacao_bancaria==1){echo 'Sim';} else{ echo 'Não';} ?></td></tr>
<tr><td class=datacelltwo>IBAN</td> <td class=datacelltwo><?php echo $iban ?></td></tr>
<tr><td class=datacellone>Nome da via</td><td class=datacellone><div style="width:300px;"><?php echo $nome_via ?></div></td></tr>
<tr><td class=datacelltwo>Tipo de via</td> <td class=datacelltwo><?php echo $tipo_via ?></td></tr>
<tr><td class=datacellone>Número da porta</td> <td class=datacellone><?php echo $numero_porta ?></td></tr>
<tr><td class=datacelltwo>Piso</td> <td class=datacelltwo><?php echo $piso ?></td></tr>
<tr><td class=datacellone>Lado</td> <td class=datacellone><?php echo $lado ?></td></tr>
<tr><td class=datacelltwo>Habitação</td> <td class=datacelltwo><?php echo $habitacao ?></td></tr>
<tr><td class=datacellone>Código postal</td> <td class=datacellone><?php echo $codigo_postal ?></td></tr>
<tr><td class=datacelltwo>Localidade</td> <td class=datacelltwo><?php echo $localidade ?></td></tr>
<tr><td class=datacellone>Nome do Cliente</td> <td class=datacellone><?php echo $nome_cliente ?></td></tr>
<tr><td class=datacelltwo>ID do Cliente</td> <td class=datacelltwo><?php echo $id_cliente ?></td></tr>
</table>
</center>
</div>
<form id="documento" name="documento" action="ver_dados.php?id_contrato=<?php echo $_GET['id_contrato'];?>&id_documento=<?php echo $_GET['id_documento']?>" method="post">
<div style="text-align:right;margin-top:30px; margin-right:10px;">
<input type="hidden" name="submit" value="submit">
<input type="submit" value="Enviei este documento" />
<input type="button" value="Fechar" onclick="self.close ()"/>
</form>
<?php
	if (isset($_POST['submit'])) 
	{
		$query=mysql_query("UPDATE documentos SET enviado=1 where ID_DOCUMENTO=$id_documento");
		?>
		<script language="javascript">
		setTimeout("self.close();",1)
		</script> 
		<?php
	}
	
?>
</div>