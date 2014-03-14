<?php

  if(!$admin) header("location:?a=admin");

  function partidaFormataData($data, $toDB)
  {
    if($toDB)
      return implode("-", array_reverse(explode("/", $data)));
    else
      return implode("/", array_reverse(explode("-", $data)));
  }

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  $partidaCtr = new PartidaController($db);
  $localCtr = new LocalController($db);
  $ingressosClassesCtr = new IngressosClassesController($db);

  $locais = $localCtr->all();

  $partida_id = $_GET["partida"];

  if(isset($partida_id))
  {
    $partida = $partidaCtr->byId($partida_id);
    $nome = $partida->get("nome");
    $data = partidaFormataData($partida->get("data"), false);
    $tipo = $partida->get("tipo");
    $local_id = $partida->get("local_id");

    $ingressosClasses = $ingressosClassesCtr->byPartidaId($partida_id);
  } else {
    $partida = new Partida();
    $ingressosClasses = array();
  }

  if(isset($_GET['post']))
  {
    $nome = $_POST["nome"];
    $data = partidaFormataData($_POST["data"], true);
    $tipo = $_POST["tipo"];
    $local_id = $_POST["local_id"];

    $partida->set("nome", $nome);
    $partida->set("data", $data);
    $partida->set("tipo", $tipo);
    $partida->set("local_id", $local_id);

      if(isset($partida_id))
      {
        if($partidaCtr->update($partida))
          $successMsg = "Partida atualizada com sucesso!";
      } else {
        $partida = $partidaCtr->create($partida);
        $partida_id = $partida->get("id");
        $successMsg = "Local cadastrado com sucesso!";
      }
      
      if(!$partida)
      {
        $errorMsg = "Erro ao cadastrar partida!";
      }
    }

    if(isset($_GET["remove"]))
    {
      $query = $_GET["q"];
      $partidaCtr->delete($partida);
      header("location:?a=partida.buscar.admin&q=$query");
    }

?>

<?php
  if($errorMsg) {
?>

<div class="panel panel-danger">
  <div class="panel-heading">Erro</div>
  <div class="panel-body">
    <?php echo $errorMsg; ?>
  </div>
</div>

<?php
  }
?>

<?php
  if($successMsg) {
?>

<div class="panel panel-success">
  <div class="panel-heading">Sucesso!</div>
  <div class="panel-body">
    <?php echo $successMsg; ?>
  </div>
</div>

<?php
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
  <div class="panel-heading"><font size="5"><strong>Cadastro de Partidas</strong></font></div>
  <div class="panel-body">

    <form action="?a=partida.admin&post&<?php if(isset($partida_id)) echo "partida=$partida_id"; ?>" method = "post">
      O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
      <table>
        <tr>
          <td class="tdlabel">Nome<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>"></td>
        </tr>

        <tr>
          <td class="tdlabel">Data<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="data" class="form-control" value="<?php echo partidaFormataData($data, false); ?>"></td>
        </tr>

        <tr>
          <td class="tdlabel">Tipo<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="tipo" class="form-control" value="<?php echo $tipo; ?>"></td>
        </tr>        

        <tr>
          <td class="tdlabel">Local<span style="color:red">*</span>: </td>
          <td class="tdform">
            <select name="local_id" class="form-control">

              <?php foreach ($locais as $local) { ?>
                <option value="<?php echo $local->get("id"); ?>" <?php if($local_id==$local->get("id")) echo "selected=\"selected\"" ?> >
                  <?php echo $local->get("nome") ?> ( <?php echo $local->get("cidade"); ?> - <?php echo $local->get("estado"); ?> ) 
                </option>
              <?php } ?>

            </select>
          </td>
        </tr>

      </table>

      <br>
      <div class="btn-group" style="margin-left: 83px">
        <button type="clean" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-default">Enviar</button>
      </div>

    </form>

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><font size="5"><strong>Classes de Ingressos</strong></font></div>
  <div class="panel-body">

    <table class="table">

      <tr>
        <th>#</th>
        <th>Classe</th>
        <th>Restantes</th>
        <th>Total</th>
        <th>Valor</th>
        <th></th> 
        <th></th>
      </tr>

      <?php foreach ($ingressosClasses as $classe) {
          $restantes = $classe->get("total") - $classe->get("vendidos");
      ?>
        <tr>
          <td><?php echo $classe->get("id"); ?></td>
          <td><?php echo $classe->get("nome"); ?></td>
          <td><?php echo $restantes ?></td>
          <td><?php echo $classe->get("total"); ?></td>
          <td><?php echo $classe->get("valor"); ?></td>
          <td><a href="?a=ingressosClasses.admin&classe=<?php echo $classe->get("id"); ?>"><button type="button" class="btn btn-default">Editar</button></a></td>
          <td><a href="?a=ingressosClasses.admin&classe=<?php echo $classe->get("id"); ?>&remove?partida=<?php echo $partida_id; ?>"><button type="button" class="btn btn-default">Remover</button></a></td>
        </tr>
      <?php } ?>

    </table>

  </div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
