<?php

  if(!$admin) header("location:?a=admin");

  function partidaFormataData($data, $toDB)
  {
    if($toDB)
      return implode("-", array_reverse(split("/", $data)));
    else
      return implode("/", array_reverse(split("-", $data)));
  }

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  $partidaCtrl = new PartidaController($db);
  $localCtrl = new LocalController($db);

  $partidas = array();

  $query = $_GET["q"];

  if(isset($query))
  {
    $partidas = $partidaCtrl->byNome($query);
  }


?>

<div class="panel panel-default">
  <div class="panel-heading"><font size="5"><strong>Buscar partida</strong></font></div>
  <div class="panel-body">
    <form id="buscar_local" action="?" method="get" class="form-inline">
      <input type="hidden" name="a" value="partida.buscar.admin">
      <input type="text" name="q" class="form-control">
      <button type="submit" class="btn btn-default">Buscar</button>
    </form>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Resultados</div>
  <div class="panel-body">
    
    <table class="table">
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Data</th>
        <th>Tipo</th>
        <th>Local</th>
        <th></th>
        <th></th>
      </tr>

      <?php foreach ($partidas as $partida) {
          $local = $localCtrl->byId($partida->get("local_id"));
      ?>
      <tr>
        <td><?php echo $partida->get("id"); ?></td>
        <td><?php echo $partida->get("nome"); ?></td>
        <td><?php echo partidaFormataData($partida->get("data"), false); ?></td>
        <td><?php echo $partida->get("tipo"); ?></td>
        <td><?php echo $local->get("nome"); ?> ( <?php echo $local->get("cidade"); ?> - <?php echo $local->get("estado"); ?> )</td>
        <td><a href="?a=partida.admin&partida=<?php echo $partida->get("id"); ?>"><button type="button" class="btn btn-default">Editar</button></a></td>
        <td><a href="?a=partida.admin&partida=<?php echo $partida->get("id"); ?>&remove&q=<?php echo $query ?>"><button type="button" class="btn btn-default">Remover</button></a></td>
      </tr>      
      <?php } ?>

    </table>

  </div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
