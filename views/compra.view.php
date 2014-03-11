<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	$ptCtr = new PartidaController($db);
	$compraCtr = new CompraController($db);
	$compradorCtr = new CompradorController($db);
	$ingressoClassCtr = new IngressosClassesController($db);
	
	$partidas = $ptCtr->proximasPartidas("2013-03-10", 5);
	
	$classePartida = $_GET["classe"];
	$compras = $ingressoClassCtr->byPartidaId();
	
?>
	

	<?php
		foreach($partidas as $key => $partida){
	?>
		<td><?php echo "Partidas disponíveis"?></td>
		<br>
		<select> <option value="">
			<td><?php echo $partida->get("nome"); ?></td>
		</option></select>
		
	<?php
		}
	?>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
