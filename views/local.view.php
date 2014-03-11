<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");
	if($_GET['post'] == "1"){
		$local = new Local(29, $_POST['nome'],$_POST['estado'],$_POST['cidade'],$_POST['rua'],
		$_POST['bairro'], $_POST['capacidade']);
		
		$localCtr = new LocalController($db);
		$locais = $localCtr->create($local);
	}
?>

<!--
		private $id;
		private $nome;
		private $estado;
		private $cidade;
		private $rua;
		private $bairro;
		private $capacidade;
-->

<div class="panel panel-default">
	<div class="panel-heading"><font size="5"><strong>Cadastro de Locais</strong></font></div>
	<div class="panel-body">
	<form action="?a=local&post=1" method = "post">
		O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
		<table>
			<tr>
				<td class="tdlabel">Nome<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="nome" class="form-control"></td>
			</tr>
			
			<tr>
				<td class="tdlabel">Estado<span style="color:red">*</span>: </td>
				<td class="tdform">
					<select class="form-control" name = "estado">
					  <option value="0">Selecione seu Estado</option>
					  <option value="AC">AC</option>
					  <option value="AL">AL</option>
					  <option value="AP">AP</option>
					  <option value="AM">AM</option>
					  <option value="BA">BA</option>
					  <option value="CE">CE</option>
					  <option value="DF">DF</option>
					  <option value="ES">ES</option>
					  <option value="GO">GO</option>
					  <option value="MA">MA</option>
					  <option value="MT">MT</option>
					  <option value="MS">MS</option>
					  <option value="MG">MG</option>
					  <option value="PA">PA</option>
					  <option value="PB">PB</option>
					  <option value="PR">PR</option>
					  <option value="PE">PE</option>
					  <option value="PI">PI</option>
					  <option value="RJ">RJ</option>
					  <option value="RN">RN</option>
					  <option value="RS">RS</option>
					  <option value="RO">RO</option>
					  <option value="RR">RR</option>
					  <option value="SC">SC</option>
					  <option value="SP">SP</option>
					  <option value="SE">SE</option>
					  <option value="TO">TO</option>
					</select></td>
			</tr>
			<tr>
				<td class="tdlabel">Cidade<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="cidade" class="form-control"></td>
			</tr>
			<tr>
				<td class="tdlabel">Rua<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="rua" class="form-control"></td>
			</tr>
			<tr>
				<td class="tdlabel">Bairro<span style="color:red">*</span>: </td>
				<td class="tdform"><input type="text" name="bairro" class="form-control"></td>
			</tr>
			<tr>
				<td class="tdlabel">Capacidade<span style="color:red">*</span>:&nbsp; </td>
				<td class="tdform"><input type="text" name="capacidade" class="form-control"></td>
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
