<?php

  if(!$admin) header("location:?a=admin");

  $partidaCtr = new PartidaController($db);
  $ingressosClassesCtr = new IngressosClassesController($db);
  $localCtr = new LocalController($db);

  function calcRestante($partida_id, $totalDiscard, $partidaCtr, $ingressosClassesCtr, $localCtr)
  {
    $partida = $partidaCtr->byId($partida_id);
    $local = $localCtr->byId($partida->get("local_id"));
    $capacidade = $local->get("capacidade");

    $total = 0;
    $classes = $ingressosClassesCtr->byPartidaId($partida_id);
    foreach ($classes as $classe) {
      $total = $total + $classe->get("total");
    }

    return $capacidade - $total + $totalDiscard;

  }

  function formatValor($valor, $toBD)
  {
    if($toBD)
      return str_replace(",", ".", $valor);
    else
      return str_replace(".", ",", $valor);
  }

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  $partidas = $partidaCtr->all();

  $ingressoClasse_id = $_GET["classe"];

  if(isset($ingressoClasse_id))
  {
    $ingressoClasse = $ingressosClassesCtr->byId($ingressoClasse_id);
    $nome = $ingressoClasse->get("nome");
    $total = $ingressoClasse->get("total");
    $valor = $ingressoClasse->get("valor");
    $vendidos = $ingressoClasse->get("vendidos");
    $partida_id = $ingressoClasse->get("partida_id");
  } else {
    $ingressoClasse = new IngressosClasses();
  }

  if(isset($_GET['post']))
  {
    $nome = $_POST["nome"];
    $total = $_POST["total"];
    $valor = $_POST["valor"];
    $vendidos = $_POST["vendidos"];
    $partida_id = $_POST["partida_id"];

    $ingressoClasse->set("nome", $nome);
    $ingressoClasse->set("total", $total);
    $ingressoClasse->set("valor", formatValor($valor, true));
    $ingressoClasse->set("vendidos", $vendidos);
    $ingressoClasse->set("partida_id", $partida_id);

    $restante = calcRestante($partida_id, $total, $partidaCtr, $ingressosClassesCtr, $localCtr);
    if($restante>=$total)
    {

      if(isset($ingressoClasse_id))
      {
        if($ingressosClassesCtr->update($ingressoClasse))
          $successMsg = "Classe atualizada com sucesso!";
      } else {
        $ingressoClasse = $ingressosClassesCtr->create($ingressoClasse);
        $ingressoClasse_id = $ingressoClasse->get("id");
        $successMsg = "Classe cadastrada com sucesso!";
      }
      
      if(!$ingressoClasse)
      {
        $errorMsg = "Erro ao cadastrar classe!";
      }

    } else {
      $errorMsg = "Quantidade acima da capacidade do local!";
    }

  }

    if(isset($_GET["remove"]))
    {
      $ingressosClassesCtr->delete($ingressoClasse);

      $partida_id = $_GET["partida"];

      if(isset($partida_id))
        header("location:?a=partida.admin&partida=$partida_id");
      else
        header("location:?a=ingressosClasses.admin");
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
  <div class="panel-heading"><font size="5"><strong>Cadastro de Classes</strong></font></div>
  <div class="panel-body">

    <form action="?a=ingressosClasses.admin&post&<?php if(isset($ingressoClasse_id)) echo "classe=$ingressoClasse_id"; ?>" method = "post">
      O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
      <table>
        <tr>
          <td class="tdlabel">Nome<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>"></td>
        </tr>

        <tr>
          <td class="tdlabel">Total<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="total" class="form-control" value="<?php echo $total; ?>"></td>
        </tr>

        <tr>
          <td class="tdlabel">Valor<span style="color:red">*</span>: </td>
          <td class="tdform"><input type="text" name="valor" class="form-control" value="<?php echo $valor; ?>"></td>
        </tr>

        <tr>
          <td class="tdlabel">Partida<span style="color:red">*</span>: </td>
          <td class="tdform">
            <select name="partida_id" class="form-control">

              <?php foreach ($partidas as $partida) {
                $restante = calcRestante($partida->get("id"), $total, $partidaCtr, $ingressosClassesCtr, $localCtr);
              ?>
                <option value="<?php echo $partida->get("id"); ?>" <?php if($partida_id==$partida->get("id")) echo "selected=\"selected\"" ?> >
                  <?php echo $partida->get("nome"); ?> (max: <?php echo $restante; ?>)
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

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
