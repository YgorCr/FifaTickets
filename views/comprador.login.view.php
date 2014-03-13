<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php


	session_start();

	$cpf = $_POST["cpf"];
	$senha = $_POST["senha"];

	if(isset($cpf) && isset($senha))
	{
		$ctr = new CompradorController($db);
		$comprador = $ctr->tryLogin($cpf, $senha);
		if($comprador)
		{
			$_SESSION["comprador_id"] = $comprador->get("id");
			header("location:?a=home");
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

<div class="panel panel-default">
  <div class="panel-heading">Login</div>
  <div class="panel-body" style="padding-left: 30%; padding-right: 36%;">

  	<form action="index.php?a=comprador.login&login" method="post">

	  	<table class="table">
	  		<tr>
	  			<td>CPF:</td>
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

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
