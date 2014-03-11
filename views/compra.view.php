<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	$ptCtr = new PartidaController($db);
	$compraCtr = new CompraController($db);
	$compradorCtr = new CompradorController($db);
	$ingressoClassCtr = new IngressosClassesController($db);
	$ingressoCtr = new IngressoController($db);

	$classe_id = $_GET["classe"];

	session_start();

	if(isset($classe_id))
	{
		$_SESSION["compra_status"]=true;
		$_SESSION["compra_classe"]=$classe_id;
		$novaClasse = $ingressoClassCtr->byId($classe_id);
	} /*else {
		header("location:?a=home");
	}*/

	$_SESSION["comprador_id"] = "1";
	$comprador_id = $_SESSION["comprador_id"];

	if(!isset($comprador_id))
	{
	
		header("location:?a=comprador");

	}

	// unset($_SESSION["compra_classes"]);
	if(!isset($_SESSION["compra_classes"]))
		$_SESSION["compra_classes"] = array();

	$classes = $_SESSION["compra_classes"];

	if(isset($classe_id))
	{

		if(isset($_GET["remove"]))
		{ 

			$classes[$classe_id]--;
			if($classes[$classe_id]<=0 || $classes[$classe_id]==null)
				unset($classes[$classe_id]);

		} else {

			if(!isset($classes[$classe_id]))
				$classes[$classe_id] = 1;
			else
				$classes[$classe_id]++;

		}

	}

	$_SESSION["compra_classes"] = $classes;

	if(isset($_SESSION["confirm"]))
	{
		$compra = new Compra();
		$compra->set("id", null);
		$compra->set("data", date("yyyy-mm-dd"));
		$compra->set("forma_de_pagamento", 0);
		$compra->set("comprador_id", $comprador_id);
		$compradorCtr->create($compra);
		foreach ($classes as $cls) {
			
		}
	}

	// print_r($_SESSION);

?>
	
<div class="panel panel-default">
  <div class="panel-heading">Compra de ingresso</div>
  <div class="panel-body">
    
    <table class="table">
    	<tr>
    		<th>#</th>
    		<th>Partida</th>
    		<th>Classe</th>
    		<th>Valor</th>
    		<th>Total</th>
    		<th></th>
    	</tr>

    	<?php
    		$i = 0;
    		foreach ($classes as $cls_id => $count) {
    			if($cls_id==null || $cls_id=="") continue;
    			$cls = $ingressoClassCtr->byId($cls_id);
    			$partida = $ptCtr->byId($cls->get("partida_id"));

    	?>

    	<tr>
    		<td><?php echo ($i+1); ?></td>
    		<td><?php echo $partida->get("nome"); ?></td>
    		<td><?php echo $cls->get("nome"); ?></td>
    		<td><?php echo $cls->get("valor"); ?></td>
    		<td><?php echo $count; ?></td>
    		<td> <a href="?a=compra&classe=<?php echo $cls->get("id") ?>&remove"> <button type="button" class="btn btn-warning btn-sm">
    	  <span class="glyphicon glyphicon-remove"></span> Remover </button> </a> </td>
    	</tr>

    	<?php
    		$i++;
    		}
    	?>

    </table>

    <center>
    	<a href="?a=compra&confirm"> <button type="button" class="btn btn-default btn-sm">
    	  <span class="glyphicon glyphicon-ok"></span> Comprar </button> </a>
    </center>

  </div>
</div>
	
<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
