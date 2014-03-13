<?php

	if(!$admin) header("location:?a=admin");

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

	$localCtr = new LocalController($db);

	$local_id = $_GET["local"];

	if(isset($local_id))
	{
		$local = $localCtr->byId($local_id);
		$nome = $local->get("nome");
		$estado = $local->get("estado");
		$cidade = $local->get("cidade");
		$rua = $local->get("rua");
		$bairro = $local->get("bairro");
		$capacidade = $local->get("capacidade");
	} else {
		$local = new Local();
	}

	if(isset($_GET['post']))
	{
		$nome = $_POST['nome'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];
		$rua = $_POST['rua'];
		$bairro = $_POST['bairro'];
		$capacidade = $_POST['capacidade'];

		$local->set("nome", $nome);
		$local->set("estado", $estado);
		$local->set("cidade", $cidade);
		$local->set("rua", $rua);
		$local->set("bairro", $bairro);
		$local->set("capacidade", $capacidade);
		
		if(isset($local_id))
		{
			if($localCtr->update($local))
				$successMsg = "Local atualizado com sucesso!";
		} else {
			$local = $localCtr->create($local);
			$local_id = $local->get("id");
			$successMsg = "Local cadastrado com sucesso!";
		}
		
		if(!$local)
		{
			$errorMsg = "Erro ao cadastrar local!";
		}
	}

	if(isset($_GET["remove"]))
	{
		$query = $_GET["q"];
		$localCtr->delete($local);
		header("location:?a=local.buscar.admin&q=$query");
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
	<div class="panel-heading"><font size="5"><strong>Cadastro de Locais</strong></font></div>
	<div class="panel-body">
	<form action="?a=local.admin&post&<?php if(isset($local_id)) echo "local=$local_id"; ?>" method = "post">
		O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
		<table>
			<tr>
				<td class="tdlabel">Nome<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>"></td>
			</tr>
			
			<tr>
				<td class="tdlabel">Estado<span style="color:red">*</span>: </td>
				<td class="tdform">
					<select class="form-control" name = "estado">
					  <option value="0">Selecione seu Estado</option>
					  <option value="AC" <?php if($_POST["estado"]=="AC") echo "selected=\"selected\""; ?> >AC</option>
					  <option value="AL" <?php if($_POST["estado"]=="AL") echo "selected=\"selected\""; ?> >AL</option>
					  <option value="AP" <?php if($_POST["estado"]=="AP") echo "selected=\"selected\""; ?> >AP</option>
					  <option value="AM" <?php if($_POST["estado"]=="AM") echo "selected=\"selected\""; ?> >AM</option>
					  <option value="BA" <?php if($_POST["estado"]=="BA") echo "selected=\"selected\""; ?> >BA</option>
					  <option value="CE" <?php if($_POST["estado"]=="CE") echo "selected=\"selected\""; ?> >CE</option>
					  <option value="DF" <?php if($_POST["estado"]=="DF") echo "selected=\"selected\""; ?> >DF</option>
					  <option value="ES" <?php if($_POST["estado"]=="ES") echo "selected=\"selected\""; ?> >ES</option>
					  <option value="GO" <?php if($_POST["estado"]=="GO") echo "selected=\"selected\""; ?> >GO</option>
					  <option value="MA" <?php if($_POST["estado"]=="MA") echo "selected=\"selected\""; ?> >MA</option>
					  <option value="MT" <?php if($_POST["estado"]=="MT") echo "selected=\"selected\""; ?> >MT</option>
					  <option value="MS" <?php if($_POST["estado"]=="MS") echo "selected=\"selected\""; ?> >MS</option>
					  <option value="MG" <?php if($_POST["estado"]=="MG") echo "selected=\"selected\""; ?> >MG</option>
					  <option value="PA" <?php if($_POST["estado"]=="PA") echo "selected=\"selected\""; ?> >PA</option>
					  <option value="PB" <?php if($_POST["estado"]=="PB") echo "selected=\"selected\""; ?> >PB</option>
					  <option value="PR" <?php if($_POST["estado"]=="PR") echo "selected=\"selected\""; ?> >PR</option>
					  <option value="PE" <?php if($_POST["estado"]=="PE") echo "selected=\"selected\""; ?> >PE</option>
					  <option value="PI" <?php if($_POST["estado"]=="PI") echo "selected=\"selected\""; ?> >PI</option>
					  <option value="RJ" <?php if($_POST["estado"]=="RJ") echo "selected=\"selected\""; ?> >RJ</option>
					  <option value="RN" <?php if($_POST["estado"]=="RN") echo "selected=\"selected\""; ?> >RN</option>
					  <option value="RS" <?php if($_POST["estado"]=="RS") echo "selected=\"selected\""; ?> >RS</option>
					  <option value="RO" <?php if($_POST["estado"]=="RO") echo "selected=\"selected\""; ?> >RO</option>
					  <option value="RR" <?php if($_POST["estado"]=="RR") echo "selected=\"selected\""; ?> >RR</option>
					  <option value="SC" <?php if($_POST["estado"]=="SC") echo "selected=\"selected\""; ?> >SC</option>
					  <option value="SP" <?php if($_POST["estado"]=="SP") echo "selected=\"selected\""; ?> >SP</option>
					  <option value="SE" <?php if($_POST["estado"]=="SE") echo "selected=\"selected\""; ?> >SE</option>
					  <option value="TO" <?php if($_POST["estado"]=="TO") echo "selected=\"selected\""; ?> >TO</option>
					</select></td>
			</tr>
			<tr>
				<td class="tdlabel">Cidade<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="cidade" class="form-control" value="<?php echo $cidade; ?>"></td>
			</tr>
			<tr>
				<td class="tdlabel">Rua<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="rua" class="form-control" value="<?php echo $rua; ?>"></td>
			</tr>
			<tr>
				<td class="tdlabel">Bairro<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="bairro" class="form-control" value="<?php echo $bairro; ?>"></td>
			</tr>
			<tr>
				<td class="tdlabel">Capacidade<span style="color:red">*</span>:&nbsp; </td>
				<td class="tdform"><input type="text" name="capacidade" class="form-control" value="<?php echo $capacidade; ?>"></td>
			</tr>
		</table>
		<br>
		<div class="btn-group" style="margin-left: 83px">
		  <button type="clean" class="btn btn-default">Cancelar</button>
		  <button type="submit" class="btn btn-default">Enviar</button>
		</div>
	</form>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
