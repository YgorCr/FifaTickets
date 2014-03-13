<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

	$partida_id = $_GET["id"];

	$ptCtr = new PartidaController($db);
	$partida = $ptCtr->byId($partida_id);

	$lcPtr = new LocalController($db);
	$local = $lcPtr->byId($partida->get("local_id"));

	$clsCtr = new IngressosClassesController($db);
	$classes = $clsCtr->byPartida($partida);


?>

	<div class="panel panel-default">
	  
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo $partida->get("nome"); ?></div>
	  <div class="panel-body">
	    <p>Tipo: <b><?php echo $partida->get("tipo"); ?></b></p>
	    <p>Data: <b><?php echo $partida->get("data"); ?></b></p>
	    
	    <div class="panel panel-default">
	      <div class="panel-heading">Local</div>
	      <div class="panel-body">
	        <p><?php echo $local->get("nome"); ?></p>
	        <p><?php echo $local->get("cidade"); ?> - <?php echo $local->get("estado"); ?></p>
	        <p><?php echo $local->get("rua"); ?></p>
	        <p><?php echo $local->get("bairro"); ?></p>
	        <p>Capacidade: <?php echo $local->get("capacidade"); ?></p>
	      </div>
	    </div>

	  </div>

	  <table class="table">

	  	<tr>
	  		<th>#</th>
	  		<th>Classe</th>
	  		<th>Restantes</th>
	  		<th>Total</th>
	  		<th>Valor</th>
	  		<th></th>
	  	</tr>

	  	<?php
	  		foreach ($classes as $classe) {
	  			$restantes = $classe->get("total") - $classe->get("vendidos");
	  	?>

	  	<tr>
	  		<td><?php echo $classe->get("id"); ?></td>
	  		<td><?php echo $classe->get("nome"); ?></td>
	  		<td><?php echo $restantes ?></td>
	  		<td><?php echo $classe->get("total"); ?></td>
	  		<td>R$ <?php echo $classe->get("valor"); ?></td>
	  		
	  		<?php if($restantes>0){ ?>
	  		
	  		<td><a href="?a=compra&classe=<?php echo $classe->get("id") ?>"> <button type="button" class="btn btn-default btn-sm
					">
  <span class="glyphicon glyphicon-plus"></span> Comprar </button> </a></td>
	  		
	  		<?php } else { ?>

	  		<td>Esgotado!</td>
	  		
	  		<?php } ?>

	  	</tr>

	  	<?php
	  		}
	  	?>

	  </table>

	</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
