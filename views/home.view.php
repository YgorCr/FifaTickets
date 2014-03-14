<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	$ptCtr = new PartidaController($db);
	$localCtr = new LocalController($db);

	$partidas = $ptCtr->proximasPartidas(date("y-m-d"), 5);

	$total = 0;
	$totalVendidos = 0;
	$ingressosClassesCtr = new IngressosClassesController($db);
	$classes = $ingressosClassesCtr->all(0);
	foreach ($classes as $classe) {
		$total = $total + $classe->get("total");
		$totalVendidos = $totalVendidos + $classe->get("vendidos");
	}

	$totalPartidas = count($ptCtr->all(0));

	$totalArrecadado = 0.0;
	$ingressosCtr = new IngressoController($db);
	$ingressos = $ingressosCtr->all(0);
	foreach ($ingressos as $ingresso) {
		$classe = $ingressosClassesCtr->byId($ingresso->get("ingressos_classes_id"));
		$totalArrecadado = $totalArrecadado + $classe->get("valor");
	}

?>

<div id="home-wrapper">

	<div style="float: left;">
		<img src="static/images/logo.jpg" style="width: 190px;"><br>
		
		<div class="panel panel-default">
		  <div class="panel-heading">Relatório</div>
		  <div class="panel-body">
		    
		    <table class="table">
		    	<tr>
		    		<td>Ingressos:</td>
		    		<td><?php echo $total; ?></td>
		    	</tr>

		    	<tr>
		    		<td>Vendidos:</td>
		    		<td><?php echo $totalVendidos; ?></td>
		    	</tr>

		    	<tr>
		    		<td>Partidas:</td>
		    		<td><?php echo $totalPartidas; ?></td>
		    	</tr>

		    	<tr>
		    		<td>Arrecadado:</td>
		    		<td><?php echo $totalArrecadado; ?></td>
		    	</tr>

		    </table>

		  </div>
		</div>

	</div>

	<div class="panel panel-default" style="margin-left: 18%">
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

</div>
	

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
