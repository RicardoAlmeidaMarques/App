<?php
	require("/lib/init.php");

	if(!isset($_SESSION['id']))
	{
		redirect('login.php');
		
	}
	$id_Agente=$_SESSION['id'];
	$consumo=$_GET['consumo'];
	$id=$_GET['id'];
	$id_contagem=$_GET['id_contagem'];
	$query2=mysql_query("Select Consumo_contagem_anterior from contratos where ID_Contrato=$id");
	$row2=mysql_fetch_Assoc($query2);
	if($consumo < $row2['Consumo_contagem_anterior'])
	{
	?>
		<script type="text/javascript">
								alert("Contagem inválida: O valor do novo consumo é inferior ao último valor registado.");
		</script>
	<?php
	$url = "ordens_contagem.php?pag=1";
	header("Refresh: 0; url=$url");  
	}
	else
	{
	$query=mysql_query("Select ID_CONDICAO from Contratos where ID_CONTRATO=$id");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	$id_condicao=$row['ID_CONDICAO'];
	$query=mysql_query("Select Termo_potencia, Termo_energia from condicoes_economicas where id_condicao=$id_condicao");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	$termo_potencia=$row['Termo_potencia'];
	$termo_energia=$row['Termo_energia'];
	$query=mysql_query("Select ID_CONTAGEM from Contagens where ID_CONTRATO=$id");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query) > 1)
	{
		$query=mysql_query("Select MAX(consumo) as penultimo_consumo,DATE(Data_contagem) As Data_penultima,CURDATE() as Data_currente, DATEDIFF(CURDATE(), Data_contagem) as dias from contagens where ID_Contrato=$id AND ID_Contagem!=$id_contagem");
		if (!$query) { die('Invalid query: ' . mysql_error()); }
		$row=mysql_fetch_assoc($query);
		$data_currente=$row['Data_currente'];
		/*$query2=mysql_query("Select SUM(PERCENTAGEM_DESCONTO) as percentagem_desconto, SUM(VALOR_DE_DESCONTO) as valor_de_desconto from promocoes where $data_currente between DATA_INICIO_PROMOCAO and DATA_FINAL_PROMOCAO");
		if (!$query2) { die('Invalid query: ' . mysql_error()); }
		$row2=mysql_fetch_assoc($query2);
		$percentagem_desconto=$row2['percentagem_desconto'];
		$valor_desconto=$row2['valor_desconto'];*/
		$consumo_mensal=$consumo-$row['penultimo_consumo'];
		$data_penultima=$row['Data_penultima'];
		$valor_a_pagar=($row['dias']*$termo_potencia)+($consumo_mensal*$termo_energia);
		Criar_documentos(-1,$id,'Fatura','Fatura referente aos consumos entre '. $data_penultima . ' e ' . $data_currente .' para o contrato ' . $id . '.',$valor_a_pagar,0,0); 
	
	}
	else{
		$query=mysql_query("Select DATEDIFF(CURDATE(), Data_contrato) as dias,CURDATE() as Data_currente,Data_contrato from contratos where ID_Contrato=$id");
		if (!$query) { die('Invalid query: ' . mysql_error()); }
		$row=mysql_fetch_assoc($query);
		$data_currente=$row['Data_currente'];
		/*$query2=mysql_query("Select SUM(PERCENTAGEM_DESCONTO) as percentagem_desconto, SUM(VALOR_DE_DESCONTO) as valor_de_desconto from promocoes where $data_currente between 'DATA_INICIO_PROMOCAO' and 'DATA_FINAL_PROMOCAO'");
		if (!$query2) { die('Invalid query: ' . mysql_error()); }
		$row2=mysql_fetch_assoc($query2);
		$percentagem_desconto=$row2['percentagem_desconto'];*/
		$data_contrato=$row['Data_contrato'];
		$valor_a_pagar=($row['dias']*$termo_potencia)+($consumo*$termo_energia);
		Criar_documentos(-1,$id,'Factura','Fatura referente aos consumos entre '. $data_contrato . ' e ' . $data_currente .' para o contrato ' . $id . '.',$valor_a_pagar,0,0); 
		
	}
	$query=mysql_query("UPDATE contagens SET Realizada=1,Data_contagem=sysdate(),Agente_responsavel=$id_Agente,Consumo=$consumo where ID_CONTRATO=$id AND ID_CONTAGEM=$id_contagem");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$query=mysql_query("UPDATE contratos SET Data_ultima_contagem=sysdate(),Consumo_contagem_anterior=$consumo where ID_CONTRATO=$id");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	redirect('ordens_contagem.php?pag=1');
	}
?>
