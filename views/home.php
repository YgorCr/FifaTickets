<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	$ptCtr = new PartidaController($db);
	$localCtr = new LocalController($db);

	$partidas = $ptCtr->proximasPartidas("2013-03-10", 5);
?>

<table class="table">

	<tr>
		<th>#</th>
		<th>Partida:</th>
		<th>Tipo:</th>
		<th>Data:</th>
		<th>Local:</th>
	</tr>

	<?php
		foreach ($partidas as $partida) {
			$local = $localCtr->byId($partida->get("local_id"));
	?>

	<tr>
		<td><?php echo $partida->get("id"); ?></td>
		<td><?php echo $partida->get("nome"); ?></td>
		<td><?php echo $partida->get("tipo"); ?></td>
		<td><?php echo $partida->get("data"); ?></td>
		<td><?php echo $local->get("nome"); ?></td>
	</tr>

	<?php
		}
	?>

</table>
	

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>