<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	$ptCtr = new PartidaController($db);
	$localCtr = new LocalController($db);

	$partidas = $ptCtr->proximasPartidas(date("y-m-d"), 5);
?>

<div class="panel panel-default">
  <div class="panel-heading">Próximas partidas</div>
  <div class="panel-body">

	<table class="table">

		<tr>
			<th>#</th>
			<th>Partida</th>
			<th>Tipo</th>
			<th>Data</th>
			<th>Local</th>
			<th><th>
		</tr>

		<?php
			foreach ($partidas as $key => $partida) {
				$local = $localCtr->byId($partida->get("local_id"));
				$class = ($key%2)?("success"):("");
		?>
				<tr class = "<?php echo $class; ?>" >
					<td><?php echo $partida->get("id"); ?></td>
					<td><?php echo $partida->get("nome"); ?></td>
					<td><?php echo $partida->get("tipo"); ?></td>
					<td><?php echo $partida->get("data"); ?></td>
					<td><?php echo $local->get("nome"); ?></td>
					<td><a href="?a=partida&id=<?php echo $partida->get("id") ?>"> <button type="button" class="btn btn-default btn-sm
						">
	  <span class="glyphicon glyphicon-info-sign"></span> Ver </button> </a></td>
				</tr>

		<?php
			}
		?>

	</table>

	</div>
</div>
	

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
