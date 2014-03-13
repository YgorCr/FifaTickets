<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

  session_start();

  $cpf = $_POST["cpf"];
  $senha = $_POST["senha"];

  if(isset($cpf) && isset($senha))
  {
    $ctr = new AdministradorController($db);
    $admin = $ctr->tryLogin($cpf, $senha);
    if($admin)
    {
      $_SESSION["admin_id"] = $admin->get("id");
      header("location:?a=admin");
    } else {
      $errorMsg = "Falha no login!";
    }
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

<?php if(!$admin) { ?>

<div class="panel panel-default">
  <div class="panel-heading">Admin Login</div>
  <div class="panel-body" style="padding-left: 30%; padding-right: 36%;">

    <form action="index.php?a=admin&login" method="post">

      <table class="table">
        <tr>
          <td>CPF/Cod:</td>
          <td><input type="text" class="form-control" name="cpf"></td>
        </tr>

        <tr>
          <td>Senha:</td>
          <td><input type="password" class="form-control" name="senha"></td>
        </tr>

      </table>

      <div>
        <center>
          <button type="clean" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-default">Entrar</button>
        </center>
      </div>

    </form>

  </div>
</div>

<?php } else { ?>

<div class="panel panel-default">
  <div class="panel-heading">Admin Options</div>
  <div class="panel-body">

    <ul class="list-group">
      <li class="list-group-item"><a href="?a=local.admin">Novo local</a></li>
      <li class="list-group-item"><a href="?a=partida.admin">Nova partida</a></li>
      <li class="list-group-item"><a href="?a=ingressosClasses.admin">Nova classe de ingressos</a></li>
    </ul>

  </div>
</div>

<?php } ?>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
