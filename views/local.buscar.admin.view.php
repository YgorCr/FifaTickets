<?php

  if(!$admin) header("location:?a=admin");

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  $localCtrl = new LocalController($db);

  $locais = array();

  $query = $_GET["q"];

  if(isset($query))
  {
    $locais = $localCtrl->byNome($query);
  }


?>

<div class="panel panel-default">
  <div class="panel-heading"><font size="5"><strong>Buscar local</strong></font></div>
  <div class="panel-body">
    <form id="buscar_local" action="?" method="get" class="form-inline">
      <input type="hidden" name="a" value="local.buscar.admin">
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
        <th>Cidade - Estado</th>
        <th>Capacidade</th>
        <th></th>
        <th></th>
      </tr>

      <?php foreach ($locais as $local) { ?>
      <tr>
        <td><?php echo $local->get("id"); ?></td>
        <td><?php echo $local->get("nome"); ?></td>
        <td><?php echo $local->get("cidade"); ?> - <?php echo $local->get("estado"); ?></td>
        <td><?php echo $local->get("capacidade"); ?></td>
        <td><a href="?a=local.admin&local=<?php echo $local->get("id"); ?>"><button type="button" class="btn btn-default">Editar</button></a></td>
        <td><a href="?a=local.admin&local=<?php echo $local->get("id"); ?>&remove&q=<?php echo $query ?>"><button type="button" class="btn btn-default">Remover</button></a></td>
      </tr>      
      <?php } ?>

    </table>

  </div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
