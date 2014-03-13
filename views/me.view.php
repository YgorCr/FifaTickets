<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  function formataData($data, $toDB)
  {
    if($toDB)
      return implode("-", array_reverse(split("/", $data)));
    else
      return implode("/", array_reverse(split("-", $data)));
  }

  if(!$comprador)
    header("location:?a=comprador");

  $compraCtr = new CompraController($db);
  $compras = $compraCtr->byComprador($comprador);

  $ingressoCtr = new IngressoController($db);
  $ingressosClassesCtr = new IngressosClassesController($db);
  $partidaCtr = new PartidaController($db);
  $localCtr = new LocalController($db);

?>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo $comprador->get("nome"); ?></div>
  <div class="panel-body">
    
    <a href="?a=compra">
    <button type="button" class="btn btn-default btn-lg">
      <span class="glyphicon glyphicon-shopping-cart"></span> Compras
    </button>
    </a>

    <a href="?a=logout">
    <button type="button" class="btn btn-default btn-lg">
      <span class="glyphicon glyphicon-off"></span> Sair
    </button>
    </a>

    <p>

    <div class="panel panel-default">
      <div class="panel-heading hdefault">Meus ingressos</div>
      <div class="panel-body">

        <?php foreach ($compras as $compra) { 
          $ingressos = $ingressoCtr->byCompra($compra);
          $groups = array();
          foreach ($ingressos as $ingresso) {
            if(!isset($groups[$ingresso->get("id")]))
              $groups[$ingresso->get("id")]=0;
            $groups[$ingresso->get("id")] = $groups[$ingresso->get("id")] + 1;
          }
        ?>
        <div class="panel panel-default">
          <div class="panel-heading hdefault">Compra em <?php echo formataData($compra->get("data"), false); ?></div>
          <div class="panel-body">

              <table class="table">
                <tr>
                  <th>#</th>
                  <th>Partida</th>
                  <th>Local</th>
                </tr>

                <?php $i=1; 
                  foreach ($groups as $id => $count) { 
                    $ingresso = $ingressoCtr->byId($id);
                    $classe = $ingressosClassesCtr->byId($ingresso->get("ingressos_classes_id"));
                    $partida = $partidaCtr->byId($classe->get("partida_id"));
                    $local = $localCtr->byId($partida->get("local_id"));
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <?php echo $partida->get("nome")." ( ".formataData($partida->get("data"))." )" ?>
                    </td>
                    <td>
                      <?php echo $local->get("nome")." ( ".$local->get("cidade")." - ".$local->get("estado")." )" ?>
                    </td>
                  </tr>
                <?php } ?>

              </table>

          </div>
        </div>
        <?php } ?>

      </div>
    </div>

  </div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
