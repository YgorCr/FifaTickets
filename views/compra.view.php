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

	if(!$comprador)
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
			$vendidos = $novaClasse->get("vendidos");
			$vendidos--;
			$novaClasse->set("vendidos", $vendidos);
			$ingressoClassCtr->update($novaClasse);
			if($classes[$classe_id]<=0 || $classes[$classe_id]==null)
				unset($classes[$classe_id]);

		} else {

			$vendidos = $novaClasse->get("vendidos");
			$total = $novaClasse->get("total");
			if($vendidos<$total)
			{
				$vendidos++;
				$novaClasse->set("vendidos",$vendidos);
				$ingressoClassCtr->update($novaClasse);	

				if(!isset($classes[$classe_id]))
					$classes[$classe_id] = 1;
				else
					$classes[$classe_id]++;
			} else {
				$errorMsg = "Ingressos esgotados!";
			}

		}

	}

	$_SESSION["compra_classes"] = $classes;

	if(isset($_GET["confirm"]))
	{
		$pagamento = $_GET["pagamento"];
		if($pagamento>1 || $pagamento==null) $pagamento=0;

		try {
			$compra = new Compra();
			// $compra->set("id", "default"); ID É GERADO NO BANCO!
			$compra->set("data", date("d/m/y"));
			$compra->set("forma_de_pagamento", $pagamento);
			$compra->set("comprador_id", $comprador_id);
			$compra = $compraCtr->create($compra);
			foreach ($classes as $cls_id => $count ) {
				$ingressoCls = $ingressoClassCtr->byId($cls_id);
				for($i=0;$i<$count;$i++)
				{
					$ingresso = new Ingresso();
					$ingresso->set("ingressos_classes_id", $cls_id);
					$ingresso->set("compra_id", $compra->get("id"));
					$ingressoCtr->create($ingresso);
				}
			}
		} catch(Exception $e) {
			echo "Erro ao processar a compra!";
			return;
		}
		unset($_SESSION["compra_classes"]);
		$_SESSION["compra_status"]=false;
		$compraResult = true;
	}

	// print_r($_SESSION);

?>

<script type="text/javascript">
function confirm()
{
	var url = "?a=compra&pagamento="+$("#pagamento_select").val()+"&confirm";
	window.location=url;
}
</script>

<?php
	if($errorMsg!=null) {
?>
	
	<div class="panel panel-warning">
	  <div class="panel-heading">Erro!</div>
	  <div class="panel-body">
	    <?php echo $errorMsg; ?>
	  </div>
	</div>

<?php
	}
?>

<div class="panel panel-default">
  <div class="panel-heading">Compra de ingresso</div>
  <div class="panel-body">
    
    <?php if(!$compraResult) { ?>

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
    		$totalGeral = 0.0;
    		foreach ($classes as $cls_id => $count) {
    			if($cls_id==null || $cls_id=="") continue;
    			$cls = $ingressoClassCtr->byId($cls_id);
    			$partida = $ptCtr->byId($cls->get("partida_id"));
    			$totalGeral = $totalGeral + $count * $cls->get("valor");

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
    	<tr>
    		<td><b>Total:</b></td>
    		<td></td>
    		<td></td>
    		<td></td>
    		<td></td>
    		<td><b><?php echo $totalGeral ?></b></td>
    	</tr>

    	<tr>
    		<td><b>Forma de pagamento:</b></td>
    		<td></td>
    		<td>
    			<select class="form-control" id="pagamento_select">
    				<option value="0">Boleto</option>
    				<option value="1">Cartão</option>
    			</select>
    		</td>
    		<td></td>
    		<td></td>
    		<td></td>
    	</tr>

    </table>

    <center>
    	<button type="button" class="btn btn-default btn-sm" onclick="javascript:confirm();">
    	  <span class="glyphicon glyphicon-ok"></span> Comprar </button>
    </center>

    <?php } else { ?>

    Compra realizada com sucesso!

    <?php } ?>

  </div>
</div>
	
<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
