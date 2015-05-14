
<?php
//funções para manipular agentes

function Adicionar_Agente($ID_Tipo_Agente, $Nome_Utilizador, $Password, $Nome, $Telefone, $Morada, $Codigo_Postal) {
	$query=mysql_query("select MAX(ID_Agente) as MAX FROM Agente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Agente(ID_Agente,Codigo_Agente, ID_Tipo_Agente,Nome_Utilizador,Password,Nome_Agente,Telefone_Agente,Morada_Agente,Codigo_Postal_Agente,Status)
	VALUES($next_id, $next_id, $ID_Tipo_Agente, '$Nome_Utilizador', '$Password', '$Nome',$Telefone,'$Morada','$Codigo_Postal',1)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Agente($ID_Agente, $ID_Tipo_Agente, $Password, $Nome, $Telefone, $Morada, $Codigo_Postal, $Estado) {
	$query=mysql_query("Update Agente SET ID_Tipo_Agente=$ID_Tipo_Agente, Password='$Password', Nome_Agente='$Nome', Telefone_Agente='$Telefone', Morada_Agente='$Morada',
	Codigo_Postal_Agente='$Codigo_Postal', Status=$Estado WHERE ID_Agente=$ID_Agente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}


function Mostrar_Agente($id,$id_agente) {
	$query2=mysql_query("Select ID_Agente, Agente.ID_Tipo_Agente, Nome_Tipo ,Codigo_Agente, Nome_Agente,Telefone_Agente, Morada_Agente, Agente.Status from Agente, Tipo_Agente where Agente.ID_Tipo_Agente=Tipo_Agente.ID_Tipo_Agente and Agente.ID_Agente=$id_agente");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	else{
	echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>Código</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Morada</center></td><td><center><b>Tipo</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	echo '<tr><td class="datacelltwo"><div style="width:20px;">' . $row["Codigo_Agente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Agente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_Agente"] . '</td><td class="datacelltwo"><div style="width:230px;">' . $row["Morada_Agente"] . '</div></td><td class="datacelltwo"><div style="width:65px;">' .
			$row['Nome_Tipo']. '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_agente.php?id=' . $row['ID_Agente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}


function Mostrar_Agente_nome($id,$criterio) {
	$query2=mysql_query("Select ID_Agente, Agente.ID_Tipo_Agente, Nome_Tipo ,Codigo_Agente, Nome_Agente,Telefone_Agente, Morada_Agente, Agente.Status from Agente, Tipo_Agente where Agente.ID_Tipo_Agente=Tipo_Agente.ID_Tipo_Agente and Agente.Nome_Agente like '%$criterio%'");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	
	else
	{echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>Código</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Morada</center></td><td><center><b>Tipo</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	echo '<tr><td class="datacelltwo"><div style="width:20px;">' . $row["Codigo_Agente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Agente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_Agente"] . '</td><td class="datacelltwo"><div style="width:230px;">' . $row["Morada_Agente"] . '</div></td><td class="datacelltwo"><div style="width:65px;">' .
			$row['Nome_Tipo']. '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_agente.php?id=' . $row['ID_Agente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}	
	
	
function Mostrar_Agentes($pagina, $id) {
	$i=1;
	if($pagina==1)
	{
		$query=mysql_query("Select ID_Agente, Agente.ID_Tipo_Agente, Nome_Tipo ,Codigo_Agente, Nome_Agente,Telefone_Agente, Morada_Agente, Agente.Status from Agente, Tipo_Agente where Agente.ID_Tipo_Agente=Tipo_Agente.ID_Tipo_Agente order by Codigo_Agente LIMIT 0, 10 ");
	}
	else
	{
		$inicio=(($pagina*10)-10);
		$query=mysql_query("Select ID_Agente, Agente.ID_Tipo_Agente, Nome_Tipo ,Codigo_Agente, Nome_Agente,Telefone_Agente, Morada_Agente, Agente.Status from Agente, Tipo_Agente where Agente.ID_Tipo_Agente=Tipo_Agente.ID_Tipo_Agente order by Codigo_Agente LIMIT $inicio, 10 ");
	}
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>Código</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Morada</center></td><td><center><b>Tipo</td><td><center><b>Estado</td></tr>';
	
	while ($row = mysql_fetch_assoc($query))
		{
			if($i %2){
			echo '<td class="datacellone"><div style="min-width:20px;">' . $row["Codigo_Agente"] . '</div></td><td class="datacellone"><div style="width:200px;">' . $row["Nome_Agente"] . '</div></td><td class="datacellone"><div style="width:75px;">' . $row["Telefone_Agente"] . '</td><td class="datacellone"><div style="width:230px;">' . $row["Morada_Agente"] . '</div></td><td class="datacellone"><div style="width:65px;">' .
			$row['Nome_Tipo']. '</div></td><td class="datacellone">';
			if($row['Status']==1){echo '<div style="color:green;width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red;width:47px;text-align:center;">Inactivo</div>';}
			echo '<td class="datacellone">' . '<a href="editar_agente.php?id=' . $row['ID_Agente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			
			$i=$i+1;
			}
			else{
			
			echo '<tr><td class="datacelltwo"><div style="min-width:20px;">' . $row["Codigo_Agente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Agente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_Agente"] . '</td><td class="datacelltwo"><div style="width:230px;">' . $row["Morada_Agente"] . '</div></td><td class="datacelltwo"><div style="width:65px;">' .
			$row['Nome_Tipo']. '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green;width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red;width:47px;text-align:center;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_agente.php?id=' . $row['ID_Agente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			
			echo '</td></tr>';
			$i=$i+1;
			}
			
		}
	echo '</table></div>';
}
	
	
//funções para manipular tipos agente

function Adicionar_Tipo_Agente($Nome_Tipo, $Descricao, $Adicionar_Cliente,$Editar_Cliente,$Adicionar_Tipo_Contagem,$Editar_Tipo_Contagem,
								$Adicionar_Agente,$Editar_Agente,$Adicionar_Tipo_Agente,$Editar_Tipo_Agente,$Adicionar_Tipos_Ciclo,$Editar_Tipos_Ciclo,
								$Adicionar_Condicoes_Economicas,$Editar_Condicoes_Economicas,$Criar_Contratos,$Editar_Contratos,
								$Criar_Documentos,$Editar_Documentos,$Criar_Tipos_Documentos,$Editar_Tipos_Documentos,$Efectuar_contagens,$status) {
	$query=mysql_query("select MAX(ID_Tipo_Agente) as MAX FROM Tipo_Agente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Tipo_Agente(ID_Tipo_Agente,Nome_Tipo, Descricao, Adicionar_Cliente,Editar_Cliente,Adicionar_Tipo_Contagem,Editar_Tipo_Contagem,
								Adicionar_Agente,Editar_Agente,Adicionar_Tipo_Agente,Editar_Tipo_Agente,Adicionar_Tipos_Ciclo,Editar_Tipos_Ciclo,
								Adicionar_Condicoes_Economicas,Editar_Condicoes_Economicas,Criar_Contratos,Editar_Contratos,
								Criar_Documentos,Editar_Documentos,Criar_Tipos_Documentos,Editar_Tipos_Documentos,Efectuar_contagem,Status)
	VALUES($next_id, '$Nome_Tipo', '$Descricao', $Adicionar_Cliente,$Editar_Cliente,$Adicionar_Tipo_Contagem,$Editar_Tipo_Contagem,
								$Adicionar_Agente,$Editar_Agente,$Adicionar_Tipo_Agente,$Editar_Tipo_Agente,$Adicionar_Tipos_Ciclo,$Editar_Tipos_Ciclo,
								$Adicionar_Condicoes_Economicas,$Editar_Condicoes_Economicas,$Criar_Contratos,$Editar_Contratos,
								$Criar_Documentos,$Editar_Documentos,$Criar_Tipos_Documentos,$Editar_Tipos_Documentos,$Efectuar_contagens,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Tipos_Agente($id_tipo ,$Nome_Tipo, $Descricao, $Adicionar_Cliente,$Editar_Cliente,$Adicionar_Tipo_Contagem,$Editar_Tipo_Contagem,
								$Adicionar_Agente,$Editar_Agente,$Adicionar_Tipo_Agente,$Editar_Tipo_Agente,$Adicionar_Tipos_Ciclo,$Editar_Tipos_Ciclo,
								$Adicionar_Condicoes_Economicas,$Editar_Condicoes_Economicas,$Criar_Contratos,$Editar_Contratos,
								$Criar_Documentos,$Editar_Documentos,$Criar_Tipos_Documentos,$Editar_Tipos_Documentos,$Efectuar_contagens,$Status){
	$query=mysql_query("Update Tipo_Agente SET Nome_Tipo='$Nome_Tipo', Descricao='$Descricao', Adicionar_Cliente=$Adicionar_Cliente, Editar_Cliente=$Editar_Cliente,
								Adicionar_Tipo_Contagem=$Adicionar_Tipo_Contagem, Editar_Tipo_Contagem=$Editar_Tipo_Contagem, Adicionar_Agente=$Adicionar_Agente,
								Editar_Agente=$Editar_Agente, Adicionar_Tipo_Agente=$Adicionar_Tipo_Agente, Editar_Tipo_Agente=$Editar_Tipo_Agente,
								Adicionar_Tipos_Ciclo=$Adicionar_Tipos_Ciclo, Editar_Tipos_Ciclo=$Editar_Tipos_Ciclo,
								Adicionar_Condicoes_Economicas=$Adicionar_Condicoes_Economicas, Editar_Condicoes_Economicas=$Editar_Condicoes_Economicas,
								Criar_Contratos=$Criar_Contratos, Editar_Contratos=$Editar_Contratos,
								Criar_Documentos=$Criar_Documentos, Editar_Documentos=$Editar_Documentos, Criar_Tipos_Documentos=$Criar_Tipos_Documentos,
								Editar_Tipos_Documentos=$Editar_Tipos_Documentos,Efectuar_contagem=$Efectuar_contagens, Status=$Status where ID_TIPO_AGENTE=$id_tipo");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}


	
	
//funções para manipular clientes
function Adicionar_Cliente($Nome_Cliente,$Contribuinte,$CAE,$Necessidades_Especiais,$Prioritario,$contacto,$Telefone_1,$Telefone_2,$Data_Nascimento,$Fax,$Tipo_Utilizacao,
							$Tipo_Via,$Nome_Via,$Numero_Porta,$Piso,$Lado,$Habitacao,$Codigo_Postal,$Localidade_Cliente,$BI,$status) {
	$query=mysql_query("select MAX(ID_Cliente) as MAX FROM Cliente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Cliente(ID_Cliente,Nome_Cliente,Contribuinte,CAE,Necessidades_Especiais,Prioritario,Contacto,Telefone_1,Telefone_2,Data_Nascimento,Fax,Tipo_Utilizacao,
	Tipo_Via,Nome_Via,Numero_Porta,Piso,Lado,Habitacao,Codigo_Postal,Localidade_Cliente,BI,Status)
	VALUES($next_id, '$Nome_Cliente',$Contribuinte,'$CAE',$Necessidades_Especiais,$Prioritario,'$contacto',$Telefone_1,$Telefone_2,'$Data_Nascimento',$Fax,'$Tipo_Utilizacao',
							'$Tipo_Via','$Nome_Via','$Numero_Porta','$Piso','$Lado','$Habitacao','$Codigo_Postal','$Localidade_Cliente',$BI,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Cliente($ID_Cliente,$Nome_Cliente,$Contribuinte,$CAE,$Necessidades_Especiais,$Prioritario,$contacto,$Telefone_1,$Telefone_2,$Data_Nascimento,$Fax,$Tipo_Utilizacao,
							$Tipo_Via,$Nome_Via,$Numero_Porta,$Piso,$Lado,$Habitacao,$Codigo_Postal,$Localidade_Cliente,$BI,$Status) {
	$query=mysql_query("Update Cliente SET Nome_Cliente='$Nome_Cliente', Contribuinte=$Contribuinte,CAE='$CAE',Necessidades_Especiais=$Necessidades_Especiais,Prioritario=$Prioritario,
	Contacto='$contacto', Telefone_1=$Telefone_1,Telefone_2=$Telefone_2,Data_Nascimento='$Data_Nascimento',Fax=$Fax,Tipo_Utilizacao='$Tipo_Utilizacao',Tipo_Via='$Tipo_Via',Nome_Via='$Nome_Via',
	Numero_Porta='$Numero_Porta',Piso='$Piso',Lado='$Lado',Habitacao='$Habitacao',Codigo_Postal='$Codigo_Postal',Localidade_Cliente='$Localidade_Cliente',BI=$BI, Status=$Status WHERE ID_Cliente=$ID_Cliente");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}



function Mostrar_Clientes($pagina, $id) {
	$i=1;
	if($pagina==1)
	{
		$query=mysql_query("Select ID_Cliente, Nome_Cliente, Telefone_1 , Nome_Via, Status from Cliente order by ID_Cliente LIMIT 0, 10 ");
	}
	else
	{
		$inicio=(($pagina*10)-10);
		$query=mysql_query("Select ID_Cliente, Nome_Cliente, Telefone_1 , Nome_Via, Status from Cliente from Cliente order by ID_Cliente LIMIT $inicio, 10 ");
	}
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Nome da Via</center></td><td><center><b>Contratos</td><td><center><b>Estado</td></tr>';
	
	while ($row = mysql_fetch_assoc($query))
		{
			$id=$row["ID_Cliente"];
			$query2=mysql_query("Select Count(ID_Contrato) AS Numero_contratos from Contratos where ID_Cliente=$id");
			$row2=mysql_fetch_assoc($query2);
			$numero_contratos=$row2['Numero_contratos'];
			if($i %2){
				echo '<td class="datacellone"><div style="min-width:30px; text-align:center;">' . $row["ID_Cliente"] . '</div></td><td class="datacellone"><div style="width:200px;">' . $row["Nome_Cliente"] . '</div></td><td class="datacellone"><div style="width:75px;">' . $row["Telefone_1"] . '</td><td class="datacellone"><div style="width:190px;">' . $row["Nome_Via"] . '</div></td><td class="datacellone"><div style="width:105px;text-align:center;">
				' . $numero_contratos . '<br><div style="font-size:12px;"><a href="editar_contratos.php?id_cliente='. $row['ID_Cliente'] . '">Editar Contratos</a><br><a href="adicionar_contrato.php?id='. $id .'&checked=yes">Adicionar Contrato</a></div></div></td><td class="datacellone">';
				if($row['Status']==1){echo '<div style="color:green;width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red;width:47px;text-align:center;">Inactivo</div>';}
				echo '<td class="datacellone">' . '<a href="editar_cliente.php?id=' . $row['ID_Cliente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
				
				$i=$i+1;
			}
			else{
				echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_1"] . '</td><td class="datacelltwo"><div style="width:190px;">' . $row["Nome_Via"] . '</div></td><td class="datacelltwo"><div style="width:105px;text-align:center;">
				' . $numero_contratos . '<br><div style="font-size:12px;"><a href="editar_contratos.php?id_cliente='. $row['ID_Cliente'] . '">Editar Contratos</a><br><a href="adicionar_contrato.php?id='. $id .'&checked=yes">Adicionar Contrato</a></div></div></td><td class="datacelltwo">';
				if($row['Status']==1){echo '<div style="color:green;width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red;width:47px;text-align:center;">Inactivo</div>';}
				echo '<td class="datacelltwo">' . '<a href="editar_cliente.php?id=' . $row['ID_Cliente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
				
				echo '</td></tr>';
				$i=$i+1;
			}
			
		}
	echo '</table></div>';
}


function Mostrar_Cliente($id,$id_cliente) {
	$query2=mysql_query("Select ID_Cliente, Nome_Cliente, Telefone_1 , Nome_Via, Status from Cliente where ID_Cliente=$id_cliente");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	else{
	echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Nome da Via</center></td><td><center><b>Contratos</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	$id=$row["ID_Cliente"];
			$query2=mysql_query("Select Count(ID_Contrato) AS Numero_contratos from Contratos where ID_Cliente=$id");
			$row2=mysql_fetch_assoc($query2);
			$numero_contratos=$row2['Numero_contratos'];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_1"] . '</td><td class="datacelltwo"><div style="width:190px;">' . $row["Nome_Via"] . '</div></td><td class="datacelltwo"><div style="width:105px;text-align:center;">
			' . $numero_contratos . '<br><div style="font-size:12px;"><a href="editar_contratos.php?id_cliente='. $row['ID_Cliente'] . '">Editar Contratos</a><br><a href="adicionar_contrato.php?id='. $id .'&checked=yes">Adicionar Contrato</a></div></div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_cliente.php?id=' . $row['ID_Cliente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}


function Mostrar_Cliente_nome($id,$criterio) {
	$query2=mysql_query("Select ID_Cliente, Nome_Cliente, Telefone_1 , Nome_Via, Status from Cliente where Nome_Cliente like '%$criterio%'");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	
	else
	{echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome</td><td><center><b>Telefone</td><td><center><b>Nome da Via</center></td><td><center><b>Contratos</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	$id=$row["ID_Cliente"];
			$query3=mysql_query("Select Count(ID_Contrato) AS Numero_contratos from Contratos where ID_Cliente=$id");
			$row2=mysql_fetch_assoc($query3);
			$numero_contratos=$row2['Numero_contratos'];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px;">' . $row["ID_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:200px;">' . $row["Nome_Cliente"] . '</div></td><td class="datacelltwo"><div style="width:75px;">' . $row["Telefone_1"] . '</td><td class="datacelltwo"><div style="width:190px;">' . $row["Nome_Via"] . '</div></td><td class="datacelltwo"><div style="width:105px;text-align:center;">
			' . $numero_contratos . '<br><div style="font-size:12px;"><a href="editar_contratos.php?id_cliente='. $row['ID_Cliente'] . '">Editar Contratos</a><br><a href="adicionar_contrato.php?id='. $id .'&checked=yes">Adicionar Contrato</a></div></div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_cliente.php?id=' . $row['ID_Cliente'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}
	
//funções para manipular contratos

function Criar_Contratos($ID_Cliente,$ID_Tipo_Contagem,$ID_Tipo_Ciclo,$ID_Agente,$ID_Condicao,$Data_Contrato,$Localidade_Efectivacao_Contrato,$Factura_Electronica,$Email,$Domiciliacao_Bancaria,$IBAN,
						$CPE,$Consumo,$Data_Ultima_Contagem,$Consumo_contagem_anterior,$Referencia_Contrato_Anterior,$Fases_Recepcao,$Numero_Processo,$Objecto_Ligacao,$Tipo_Via,$Nome_Via,$Numero_Porta,
						$Piso,$Lado,$Habitacao,$Codigo_Postal,$Localidade_Ponto_fornecimento,$Status) {
	$query=mysql_query("select MAX(ID_Contrato) as MAX FROM Contratos");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Contratos(ID_Contrato,ID_Cliente,ID_Tipo_Contagem,ID_Tipo_Ciclo,ID_Agente,ID_Condicao,Data_Contrato,Localidade_Efectivacao_Contrato,Factura_Electronica,Email,Domiciliacao_Bancaria,IBAN,CPE,Consumo,Data_Ultima_Contagem,Consumo_contagem_anterior,
						Referencia_Contrato_Anterior,Fases_Recepcao,Numero_Processo,Objecto_Ligacao,Tipo_Via,Nome_Via,Numero_Porta,Piso,Lado,Habitacao,Codigo_Postal,Localidade_Ponto_fornecimento,Status)
	VALUES($next_id, $ID_Cliente, $ID_Tipo_Contagem,$ID_Tipo_Ciclo,$ID_Agente,$ID_Condicao, '$Data_Contrato','$Localidade_Efectivacao_Contrato', $Factura_Electronica,'$Email',$Domiciliacao_Bancaria,'$IBAN','$CPE',0,sysdate(),0,'$Referencia_Contrato_Anterior','$Fases_Recepcao',
							'$Numero_Processo','$Objecto_Ligacao','$Tipo_Via','$Nome_Via','$Numero_Porta','$Piso','$Lado','$Habitacao','$Codigo_Postal','$Localidade_Ponto_fornecimento',1)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Contratos($ID_Contrato,$ID_Cliente,$ID_Tipo_Contagem,$ID_Tipo_Ciclo,$ID_Agente,$ID_Condicao,$Data_Contrato,$Localidade_Efectivacao_Contrato,$Factura_Electronica,$Email,$Domiciliacao_Bancaria,$IBAN,
						$CPE,$Consumo,$Data_Ultima_Contagem,$Consumo_contagem_anterior,$Referencia_Contrato_Anterior,$Fases_Recepcao,$Numero_Processo,$Objecto_Ligacao,$Tipo_Via,$Nome_Via,$Numero_Porta,
						$Piso,$Lado,$Habitacao,$Codigo_Postal,$Localidade_Ponto_fornecimento,$Status) {
	$query=mysql_query("Update Contratos SET ID_Cliente=$ID_Cliente,ID_Tipo_Contagem=$ID_Tipo_Contagem,ID_Tipo_Ciclo=$ID_Tipo_Ciclo,ID_Agente=$ID_Agente,ID_Condicao=$ID_Condicao,Data_Contrato='$Data_Contrato',Localidade_Efectivacao_Contrato='$Localidade_Efectivacao_Contrato',
						Factura_Electronica=$Factura_Electronica,Email='$Email',Domiciliacao_Bancaria=$Domiciliacao_Bancaria,IBAN='$IBAN',
						CPE='$CPE',Consumo=$Consumo,Data_Ultima_Contagem='$Data_Ultima_Contagem',Consumo_contagem_anterior=$Consumo_contagem_anterior,Referencia_Contrato_Anterior='$Referencia_Contrato_Anterior',Fases_Recepcao='$Fases_Recepcao',Numero_Processo='$Numero_Processo',
						Objecto_Ligacao='$Objecto_Ligacao',Tipo_Via='$Tipo_Via',Nome_Via='$Nome_Via',Numero_Porta='$Numero_Porta',
						Piso='$Piso',Lado='$Lado',Habitacao='$Habitacao',Codigo_Postal='$Codigo_Postal',Localidade_Ponto_fornecimento='$Localidade_Ponto_fornecimento',Status=$Status WHERE ID_Contrato=$ID_Contrato");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}
						
	
	
function Mostrar_Contratos($pagina, $id) {
	$i=1;
	if($pagina==1)
	{
		$query=mysql_query("Select ID_Contrato, Contratos.ID_Cliente, Cliente.Nome_Cliente AS Nome_Cliente, CPE , Contratos.ID_Condicao,DATA_ULTIMA_CONTAGEM, Condicoes_economicas.Valor_Potencia AS Valor_Potencia, Contratos.Status from Contratos, Cliente,Condicoes_Economicas where Contratos.ID_Cliente=Cliente.ID_Cliente && Condicoes_economicas.ID_Condicao=Contratos.ID_Condicao Order by ID_Contrato LIMIT 0, 10 ");
	}
	else
	{
		$inicio=(($pagina*10)-10);
		$query=mysql_query("Select ID_Contrato, Contratos.ID_Cliente, Cliente.Nome_Cliente AS Nome_Cliente, CPE , Contratos.ID_Condicao,DATA_ULTIMA_CONTAGEM, Condicoes_economicas.Valor_Potencia AS Valor_Potencia, Contratos.Status from Contratos, Cliente,Condicoes_Economicas where Contratos.ID_Cliente=Cliente.ID_Cliente && Condicoes_economicas.ID_Condicao=Contratos.ID_Condicao Order by ID_Contrato LIMIT $inicio, 10 ");
	}
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Última contagem</td><td><center><b>CPE</center></td><td><center><b>Potência</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query)){
	if($i %2){
	echo '<tr><td class="datacellone"><div style="min-width:30px; text-align:center;">' . $row["ID_Contrato"] . '</div></td><td class="datacellone"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["Nome_Cliente"] . '</a></div></td><td class="datacellone"><div style="width:115px; text-align:center;"><a href="ordens_contagem.php?id_contrato=' . $row["ID_Contrato"] . '">' . $row["DATA_ULTIMA_CONTAGEM"] . '</a></td><td class="datacellone"><div style="width:180px; text-align:center;">' . $row["CPE"] . '</div></td><td class="datacellone"><div style="width:75px;text-align:center;">
			' . $row["Valor_Potencia"] . '</div></td><td class="datacellone">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red; width:47px;text-align:center;">Inactivo</div>';}
			echo '<td class="datacellone">' . '<a href="editar_contrato.php?id=' . $row['ID_Contrato'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			$i=$i+1;
			}
	else{
				echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Contrato"] . '</div></td><td class="datacelltwo"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["Nome_Cliente"] . '</a></div></td><td class="datacelltwo"><div style="width:115px; text-align:center;"><a href="ordens_contagem.php?id_contrato=' . $row["ID_Contrato"] . '">' . $row["DATA_ULTIMA_CONTAGEM"] . '</a></td><td class="datacelltwo"><div style="width:180px; text-align:center;">' . $row["CPE"] . '</div></td><td class="datacelltwo"><div style="width:75px;text-align:center;">
				' . $row["Valor_Potencia"] . '</div></td><td class="datacelltwo">';
				if($row['Status']==1){echo '<div style="color:green; width:47px;text-align:center;">Activo</div>';}else{echo '<div style="color:red; width:47px;text-align:center;">Inactivo</div>';}
				echo '<td class="datacelltwo">' . '<a href="editar_contrato.php?id=' . $row['ID_Contrato'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
				$i=$i+1;
			}
			
	}
	echo '</table></div>';
}	
	
	
	
function Mostrar_Contrato($id,$id_contrato) {
	$query2=mysql_query("Select ID_Contrato, Contratos.ID_Cliente, Cliente.Nome_Cliente AS Nome_Cliente, CPE , Contratos.ID_Condicao,DATA_ULTIMA_CONTAGEM, Condicoes_economicas.Valor_Potencia AS Valor_Potencia, Contratos.Status from Contratos, Cliente,Condicoes_Economicas where ID_Contrato=$id_contrato && Contratos.ID_Cliente=Cliente.ID_Cliente && Condicoes_economicas.ID_Condicao=Contratos.ID_Condicao order by ID_Contrato");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	else{
	echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Última contagem</td><td><center><b>CPE</center></td><td><center><b>Potência</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	$id=$row["ID_Cliente"];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Contrato"] . '</div></td><td class="datacelltwo"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["Nome_Cliente"] . '</a></div></td><td class="datacelltwo"><div style="width:115px; text-align:center;"><a href="ordens_contagem.php?id_contrato=' . $row["ID_Contrato"] . '">' . $row["DATA_ULTIMA_CONTAGEM"] . '</a></td><td class="datacelltwo"><div style="width:180px; text-align:center;">' . $row["CPE"] . '</div></td><td class="datacelltwo"><div style="width:75px;text-align:center;">
			' . $row["Valor_Potencia"] . '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_contrato.php?id=' . $row['ID_Contrato'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}

function Mostrar_Contrato_cliente($id,$id_cliente) {
	$query2=mysql_query("Select ID_Contrato, Contratos.ID_Cliente, Cliente.Nome_Cliente AS Nome_Cliente, CPE , Contratos.ID_Condicao,DATA_ULTIMA_CONTAGEM, Condicoes_economicas.Valor_Potencia AS Valor_Potencia, Contratos.Status from Contratos, Cliente,Condicoes_Economicas where Contratos.ID_Cliente=$id_cliente && Cliente.ID_Cliente=Contratos.ID_Cliente && Condicoes_economicas.ID_Condicao=Contratos.ID_Condicao order by ID_Contrato");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	else{
	echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Última contagem</td><td><center><b>CPE</center></td><td><center><b>Potência</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	$id=$row["ID_Cliente"];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Contrato"] . '</div></td><td class="datacelltwo"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["Nome_Cliente"] . '</a></div></td><td class="datacelltwo"><div style="width:115px; text-align:center;"><a href="ordens_contagem.php?id_contrato=' . $row["ID_Contrato"] . '">' . $row["DATA_ULTIMA_CONTAGEM"] . '</a></td><td class="datacelltwo"><div style="width:180px; text-align:center;">' . $row["CPE"] . '</div></td><td class="datacelltwo"><div style="width:75px;text-align:center;">
			' . $row["Valor_Potencia"] . '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_contrato.php?id=' . $row['ID_Contrato'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}
	

function Mostrar_Contrato_nome($id,$criterio) {
	$query2=mysql_query("Select ID_Contrato, Contratos.ID_Cliente, Cliente.Nome_Cliente AS Nome_Cliente, CPE , Contratos.ID_Condicao,DATA_ULTIMA_CONTAGEM, Condicoes_economicas.Valor_Potencia AS Valor_Potencia, Contratos.Status from Contratos, Cliente,Condicoes_Economicas where Contratos.ID_Cliente=Cliente.ID_Cliente && Condicoes_economicas.ID_Condicao=Contratos.ID_Condicao && Cliente.Nome_Cliente like '%$criterio%' order by ID_Contrato");
	if (!$query2) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query2)==0){ echo '0 resultados.';}
	
	else
	{echo '<style type="text/css">
	td.datacelltwo {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Última contagem</td><td><center><b>CPE</center></td><td><center><b>Potência</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query2)){
	$id=$row["ID_Cliente"];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["ID_Contrato"] . '</div></td><td class="datacelltwo"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["Nome_Cliente"] . '</a></div></td><td class="datacelltwo"><div style="width:115px; text-align:center;"><a href="ordens_contagem.php?id_contrato=' . $row["ID_Contrato"] . '">' . $row["DATA_ULTIMA_CONTAGEM"] . '</a></td><td class="datacelltwo"><div style="width:180px; text-align:center;">' . $row["CPE"] . '</div></td><td class="datacelltwo"><div style="width:75px;text-align:center;">
			' . $row["Valor_Potencia"] . '</div></td><td class="datacelltwo">';
			if($row['Status']==1){echo '<div style="color:green; width:47px;">Activo</div>';}else{echo '<div style="color:red; width:47px;">Inactivo</div>';}
			echo '<td class="datacelltwo">' . '<a href="editar_contrato.php?id=' . $row['ID_Contrato'] . '"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';
			}
	echo '</table>';
	echo '</div>';
	}
}
	
//funcoes para manipular as contagens

function Adicionar_Tipo_Contagem($Nome_Contagem,$Descricao_Contagem,$periodicidade,$status){
	$query=mysql_query("select MAX(ID_Tipo_Contagem) as MAX FROM Tipo_Contagem");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Tipo_Contagem(ID_Tipo_Contagem,Nome_Contagem,Descricao_Contagem,Periodicidade,Status) Values ($next_id, '$Nome_Contagem','$Descricao_Contagem',$periodicidade,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Tipo_Contagem($ID_Tipo_Contagem,$Nome_Contagem,$Descricao_Contagem,$periodicidade,$status){
	$query=mysql_query("Update Tipo_Contagem Set Nome_Contagem='$Nome_Contagem',Descricao_Contagem='$Descricao_Contagem', Periodicidade=$periodicidade, Status=$status where ID_Tipo_Contagem=$ID_Tipo_Contagem");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Actualizar_contagens(){
	$query=mysql_query("Select data_ultima_contagem, contratos.id_contrato as id_contrato, contratos.id_tipo_contagem, tipo_contagem.periodicidade as periodicidade,sysdate() as data_actual from contratos,tipo_contagem where contratos.status=1 && tipo_contagem.id_tipo_contagem=tipo_contagem.id_tipo_contagem");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	while($row=mysql_fetch_assoc($query))
	{
		$id_contrato=$row['id_contrato'];
		$query4=mysql_query("Select * from contagens where ID_CONTRATO=$id_contrato");
		$query5=mysql_query("Select * from contagens where ID_CONTRATO=$id_contrato AND realizada=1");
		$query6=mysql_query("Select * from contagens where ID_CONTRATO=$id_contrato AND realizada=0");
		if((mysql_num_rows($query4))==0 || ((mysql_num_rows($query5))!=0 &&  (mysql_num_rows($query6))==0))
		{
			$data_actual=$row['data_actual'];
			$periodicidade=$row['periodicidade'];
			$data_ultima_contagem=$row['data_ultima_contagem'];
			$timestamp = strtotime($data_ultima_contagem);
			$timestamp2= strtotime("+$periodicidade day",$timestamp);
			$data_actual= strtotime($data_actual);
			//$data_ultima_contagem=$row['data_ultima_contagem'];
			//$date = date('Y-m-d', mktime( 0, 0, 0, $data_ultima_contagem['mon'], $data_ultima_contagem['day'] + $periodicidade, $data_ultima_contagem['year']));
			//$date = date($data_ultima_contagem, strtotime("+$periodicidade day"));
			if ($timestamp2 <= $data_actual)
			{
				$id_contrato=$row['id_contrato'];
				$query2=mysql_query("select MAX(ID_contagem) as MAX FROM contagens");
				if (!$query2) { die('Invalid query: ' . mysql_error()); }
				$row2=mysql_fetch_assoc($query2);
				if ($row2) {$next_id=$row2['MAX']+1;} else {$next_id=1;}
				$query3=mysql_query("Insert into contagens(ID_contagem, id_contrato, realizada, data_contagem, agente_responsavel) values ($next_id, $id_contrato,0,'NULL','NULL')");
				if (!$query3) { die('Invalid query: ' . mysql_error()); }
			}
		}
	}
}

	
function Mostrar_Contagens($pagina, $id) {
	$i=1;
	if($pagina==1)
	{
		$query=mysql_query("Select id_contagem, contagens.ID_Contrato as id_contrato, contratos.id_cliente as ID_Cliente, cliente.nome_cliente as nome_cliente, Realizada, Data_contagem , Agente_responsavel, contratos.nome_via as nome_via from Contagens,contratos,cliente where contagens.id_contrato=contratos.id_contrato && contratos.id_cliente=cliente.id_cliente order by Realizada && ID_Contagem LIMIT 0, 10");
	}
	else
	{
		$inicio=(($pagina*10)-10);
		$query=mysql_query("Select id_contagem, contagens.ID_Contrato as id_contrato, contratos.id_cliente as ID_Cliente, cliente.nome_cliente as nome_cliente, Realizada, Data_contagem , Agente_responsavel, contratos.nome_via as nome_via from Contagens,contratos,cliente where contagens.id_contrato=contratos.id_contrato && contratos.id_cliente=cliente.id_cliente order by Realizada && ID_Contagem LIMIT $inicio, 10 ");
	}
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Data da contagem</td><td><center><b>Nome da via</center></td><td><center><b>Agente</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query)){
	$id_contrato=$row['id_contrato'];
	$id_contagem=$row['id_contagem'];
	if($i %2){
	echo '<tr><td class="datacellone"><div style="min-width:30px; text-align:center;">' . $row["id_contagem"] . '</div></td><td class="datacellone"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["nome_cliente"] . '</a></div></td><td class="datacellone"><div style="width:115px; text-align:center;">' . $row["Data_contagem"] . '</td><td class="datacellone"><div style="width:180px; text-align:center;">' . $row["nome_via"] . '</div></td><td class="datacellone"><div style="width:60px;text-align:center;">
			' . $row["Agente_responsavel"] . '</div></td>';
			if($row['Realizada']==1){echo '<td class="datacellone" colspan="2"><div style="color:green; width:100px;text-align:center;">Efectuada</div></td></tr>';}else{echo '<td class="datacellone"><div style="color:red; width:62px; text-align:center;">Não efectuada</div>';
			echo '<td class="datacellone">' . '<a href="#" onclick="show_prompt(' .$id_contrato  . "," . $id_contagem . ')"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';}
			$i=$i+1;
			}
	else{
				echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["id_contagem"] . '</div></td><td class="datacelltwo"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["nome_cliente"] . '</a></div></td><td class="datacelltwo"><div style="width:115px; text-align:center;">' . $row["Data_contagem"] . '</td><td class="datacelltwo"><div style="width:180px; text-align:center;">' . $row["nome_via"] . '</div></td><td class="datacelltwo"><div style="width:60px;text-align:center;">
			' . $row["Agente_responsavel"] . '</div></td>';
			if($row['Realizada']==1){echo '<td class="datacelltwo" colspan="2"><div style="color:green; width:100px;text-align:center;">Efectuada</div></td></tr>';}else{echo '<td class="datacelltwo"><div style="color:red; width:62px; text-align:center;">Não efectuada</div>';
			echo '<td class="datacelltwo">' . '<a href="#" onclick="show_prompt(' .$id_contrato  . "," . $id_contagem . ')"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';}
			$i=$i+1;
			}
			
	}
	echo '</table></div>';
}	

function Mostrar_contagem($id,$id_contrato){
	$query=mysql_query("Select id_contagem, contagens.ID_Contrato as id_contrato, contratos.id_cliente as ID_Cliente, cliente.nome_cliente as nome_cliente, Realizada, Data_contagem , Agente_responsavel, contratos.nome_via as nome_via from Contagens,contratos,cliente where contagens.id_contrato=$id_contrato && contratos.id_contrato=contagens.id_contrato && contratos.id_cliente=cliente.id_cliente order by ID_Contagem LIMIT 0, 10");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	if(mysql_num_rows($query)==0){ echo '0 resultados.';}
	else
	{
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Nome do cliente</td><td><center><b>Data da contagem</td><td><center><b>Nome da via</center></td><td><center><b>Agente</td><td><center><b>Estado</td></tr>';
	while($row=mysql_fetch_assoc($query)){
	$id_contrato=$row['id_contrato'];
	$id_contagem=$row['id_contagem'];
	echo '<tr><td class="datacellone"><div style="min-width:30px; text-align:center;">' . $row["id_contagem"] . '</div></td><td class="datacellone"><div style="width:200px;"><a href="editar_clientes.php?id_cliente=' . $row["ID_Cliente"] . '">' . $row["nome_cliente"] . '</a></div></td><td class="datacellone"><div style="width:115px; text-align:center;">' . $row["Data_contagem"] . '</td><td class="datacellone"><div style="width:180px; text-align:center;">' . $row["nome_via"] . '</div></td><td class="datacellone"><div style="width:60px;text-align:center;">
			' . $row["Agente_responsavel"] . '</div></td>';
			if($row['Realizada']==1){echo '<td class="datacellone" colspan="2"><div style="color:green; width:90px;text-align:center;">Efectuada</div></td></tr>';}else{echo '<td class="datacellone"><div style="color:red; width:62px;text-align:center;">Não efectuada</div>';
			echo '<td class="datacellone">' . '<a href="#" onclick="show_prompt(' .$id_contrato  . "," . $id_contagem . ')"><img src="/img/edit.png" width=25px /></a>' . '</td></tr>';}
			}
	echo '</table>';
	echo '</div>';
	}
}


//funcoes para manipular os tipos de ciclo
	
function Adicionar_Tipos_Ciclo($Nome_Ciclo,$Descricao_Ciclo,$status){
	$query=mysql_query("select MAX(ID_Tipo_Ciclo) as MAX FROM Tipos_Ciclo");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Tipos_Ciclo(ID_Tipo_Ciclo,Nome_Ciclo,Descricao_Ciclo,Status) Values ($next_id, '$Nome_Ciclo','$Descricao_Ciclo',$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Tipos_Ciclo($ID_Tipo_Ciclo,$Nome_Ciclo,$Descricao_Ciclo,$status){
	$query=mysql_query("Update Tipos_Ciclo Set Nome_Ciclo='$Nome_Ciclo',Descricao_Ciclo='$Descricao_Ciclo',Status=$status where ID_Tipo_Ciclo=$ID_Tipo_Ciclo");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}



//funcoes para manipular condicoes economicas

function Adicionar_Condicoes_Economicas($Valor_Potencia,$Termo_Potencia,$Termo_Energia,$status){
	$query=mysql_query("select MAX(ID_Condicao) as MAX FROM Condicoes_Economicas");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Condicoes_Economicas(ID_Condicao,Valor_Potencia,Termo_Potencia,Termo_Energia,Status) Values ($next_id, $Valor_Potencia,$Termo_Potencia,$Termo_Energia,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Condicoes_Economicas($ID_Condicao,$Valor_Potencia,$Termo_Potencia,$Termo_Energia,$Status){
	$query=mysql_query("Update Condicoes_Economicas Set Valor_Potencia=$Valor_Potencia,Termo_Potencia=$Termo_Potencia,Termo_Energia=$Termo_Energia,Status=$Status where ID_Condicao=$ID_Condicao");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}


//funcoes para manipular promocoes
function adicionar_promocoes($nome,$descricao,$data_de_inicio,$data_de_fim,$valor,$percentagem,$status){
	$query=mysql_query("select MAX(ID_Promocao) as MAX FROM promocoes");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO promocoes(ID_Promocao,Nome_Promocao,Descricao_Promocao,Data_inicio_promocao,data_final_promocao,Valor_de_desconto,Percentagem_desconto,status) Values ($next_id,'$nome','$descricao','$data_de_inicio','$data_de_fim',$valor,$percentagem,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function editar_promocoes($Id,$nome,$descricao,$data_de_inicio,$data_de_fim,$valor,$percentagem,$status){
	$query=mysql_query("Update promocoes Set Nome_promocao='$nome',Descricao_promocao='$descricao',Data_inicio_promocao='$data_de_inicio',Data_final_promocao='$data_de_fim',Valor_de_desconto=$valor,Percentagem_desconto=$percentagem,Status=$status where ID_Promocao=$Id");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

//funcoes para manipular documentos

//funcoes para manipular tipos de documento
function Adicionar_Tipos_Documento($Nome_tipo_documento,$Enviar_cliente,$status){
	$query=mysql_query("select MAX(ID_Tipo_Documento) as MAX FROM Tipo_Documento");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1;}
	$query=mysql_query("INSERT INTO Tipo_Documento(ID_Tipo_documento,Nome_tipo_documento,enviar_cliente,Status) Values ($next_id, '$Nome_tipo_documento',$Enviar_cliente,$status)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}

function Editar_Tipos_Documento($Id_Tipo_documento,$Nome_tipo_documento,$Enviar_cliente,$status){
	$query=mysql_query("Update tipo_documento Set Nome_tipo_documento='$Nome_tipo_documento',Enviar_cliente=$Enviar_cliente,Status=$status where ID_tipo_documento=$Id_Tipo_documento");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}


function Criar_documentos($ID_Tipo_documento,$ID_Contrato,$Nome_Documento,$Observacoes,$Valor_a_pagar,$Data_emissao,$enviado){
	$query=mysql_query("select MAX(ID_Documento) as MAX FROM Documentos");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	if ($row) {$next_id=$row['MAX']+1;} else {$next_id=1; }
	$query=mysql_query("INSERT INTO Documentos(ID_Documento,ID_Tipo_documento,ID_Contrato,Nome_documento,Observacoes,Valor_a_pagar,Data_emissao,Enviado) Values ($next_id,$ID_Tipo_documento,$ID_Contrato,'$Nome_Documento','$Observacoes',$Valor_a_pagar,'$Data_emissao',0)");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
}


function Mostrar_ordens_documento($pagina, $id) {
	$i=1;
	if($pagina==1)
	{
		$query=mysql_query("Select id_documento,documentos.id_tipo_documento,tipo_documento.enviar_cliente as enviar, id_contrato, nome_documento, observacoes, valor_a_pagar, data_emissao, enviado from documentos,tipo_documento where documentos.id_tipo_documento=tipo_documento.id_tipo_documento order by Enviado && ID_Documento LIMIT 0, 10");
	}
	else
	{
		$inicio=(($pagina*10)-10);
		$query=mysql_query("Select id_documento,documentos.id_tipo_documento,tipo_documento.enviar_cliente as enviar, id_contrato, nome_documento, observacoes, valor_a_pagar, data_emissao, enviado from documentos,tipo_documento where documentos.id_tipo_documento=tipo_documento.id_tipo_documento order by Enviado && ID_Documento LIMIT $inicio, 10 ");
	}
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	echo '<style type="text/css">
	td.datacellone {
		background-color: #D3D3D3; color: black; border:1px solid #808080; text-align:left; padding:3px;
	}
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Documento</td><td><center><b>Obs.</td><td><center><b>Valor a pagar</center></td><td><center><b>Enviado</td></tr>';
	while($row=mysql_fetch_assoc($query)){
	$id_contrato=$row['id_contrato'];
	$id_documento=$row['id_documento'];
	$enviar=$row['enviar'];
	$obs=$row['observacoes'];
	if($i %2){
	echo '<tr><td class="datacellone"><div style="min-width:30px; text-align:center;">' . $row["id_documento"] . '</div></td><td class="datacellone"><div style="width:150px; text-align:center;">' . $row["nome_documento"] . '</div></td><td class="datacellone"><div style="width:300px; text-align:center;">' . $row["observacoes"] . '</td><td class="datacellone"><div style="width:130px; text-align:center;">' . str_replace(".", ",", $row["valor_a_pagar"]) . ' € </div></td>';
			if ($enviar==1) { if($row['enviado']==1){echo '<td class="datacellone" colspan="2"><div style="color:green; width:100px;text-align:center;">Enviado</div></td></tr>';}else{echo '<td class="datacellone"><div style="color:red; width:62px; text-align:center;">Não enviado</div>';
				echo '<td class="datacellone">' . '<a href="#" onclick="newPopup(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}}
				else {
				if($row['enviado']==1){echo '<td class="datacellone" colspan="2"><div style="color:green; width:100px;text-align:center;">Emitido</div></td></tr>';}else{echo '<td class="datacellone"><div style="color:red; width:62px; text-align:center;">Não emitido</div>';
				echo '<td class="datacellone">' . '<a href="#" onclick="newPopup2(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}}
			$i=$i+1;
			}
	else{
				echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["id_documento"] . '</div></td><td class="datacelltwo"><div style="width:150px; text-align:center;">' . $row["nome_documento"] . '</div></td><td class="datacelltwo"><div style="width:300px; text-align:center;">' . $row["observacoes"] . '</td><td class="datacelltwo"><div style="width:130px; text-align:center;">' . str_replace(".", ",", $row["valor_a_pagar"]) . ' € </div></td>';
			if ($enviar==1) { if($row['enviado']==1){echo '<td class="datacelltwo" colspan="2"><div style="color:green; width:100px;text-align:center;">Enviado</div></td></tr>';}else{echo '<td class="datacelltwo"><div style="color:red; width:62px; text-align:center;">Não enviado</div>';
				echo '<td class="datacelltwo">' . '<a href="#" onclick="newPopup(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}}
				else {
				if($row['enviado']==1){echo '<td class="datacelltwo" colspan="2"><div style="color:green; width:100px;text-align:center;">Emitido</div></td></tr>';}else{echo '<td class="datacelltwo"><div style="color:red; width:62px; text-align:center;">Não emitido</div>';
				echo '<td class="datacelltwo">' . '<a href="#" onclick="newPopup2(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}}
			$i=$i+1;
			}
			
	}
	echo '</table></div>';
}	

function Mostrar_ordem_documento($id) {
	$query=mysql_query("Select id_documento,documentos.id_tipo_documento,tipo_documento.enviar_cliente as enviar, id_contrato, nome_documento, observacoes, valor_a_pagar, data_emissao, enviado from documentos,tipo_documento where documentos.id_documento=$id && documentos.id_tipo_documento=tipo_documento.id_tipo_documento");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	$row=mysql_fetch_assoc($query);
	echo '<style type="text/css">
	td.datacelltwo {
		background-color: #E5E5E5; color: black;border:1px solid #808080; text-align:left; padding:3px;
	}
	</style>';
	echo '<div style="margin:auto;"><table><tr><td><center><b>ID</td><td><center><b>Documento</td><td><center><b>Obs.</td><td><center><b>Valor a pagar</center></td><td><center><b>Enviado</td></tr>';
	$id_contrato=$row['id_contrato'];
	$id_documento=$row['id_documento'];
	$enviar=$row['enviar'];
	$obs=$row['observacoes'];
	echo '<tr><td class="datacelltwo"><div style="min-width:30px; text-align:center;">' . $row["id_documento"] . '</div></td><td class="datacelltwo"><div style="width:150px; text-align:center;">' . $row["nome_documento"] . '</div></td><td class="datacelltwo"><div style="width:300px; text-align:center;">' . $row["observacoes"] . '</td><td class="datacelltwo"><div style="width:130px; text-align:center;">' . str_replace(".", ",", $row["valor_a_pagar"]) . ' € </div></td>';
	if ($enviar==1) { if($row['enviado']==1){echo '<td class="datacelltwo" colspan="2"><div style="color:green; width:100px;text-align:center;">Enviado</div></td></tr>';}else{echo '<td class="datacelltwo"><div style="color:red; width:62px; text-align:center;">Não enviado</div>';
		echo '<td class="datacelltwo">' . '<a href="#" onclick="newPopup(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}}
		else {
			if($row['enviado']==1){echo '<td class="datacelltwo" colspan="2"><div style="color:green; width:100px;text-align:center;">Emitido</div></td></tr>';}else{echo '<td class="datacelltwo"><div style="color:red; width:62px; text-align:center;">Não emitido</div>';
			echo '<td class="datacelltwo">' . '<a href="#" onclick="newPopup2(' .$id_contrato  . "," . $id_documento . ')"><img src="/img/add.png" width=25px /></a>' . '</td></tr>';}
			}
	
	echo '</table></div>';
}	


//extras
function verificar_nome_utilizador($username){
	$query=mysql_query("Select * from Agente where Nome_utilizador='$username'");
	if (!$query) { die('Invalid query: ' . mysql_error()); }
	if((mysql_num_rows($query))==0) {return 0;} else {return 1;}
}
	



?>
