<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<!--
	private $id;
	private $nome;
	private $cpf_cod;
	private $telefone;
	private $estado;
	private $cidade;
	private $rua;
	private $bairro;
	private $complemento;
	private $senha;
-->

<div>
	<form>
		O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
		<table>
			<tr>
				<td>Nome<span style="color:red">*</span>: </td>
				<td><input type="text" name="nome" class="form-control"><br></td>
			</tr>
			<tr>
				<td>CPF/cod<span style="color:red">*</span>: </td>
				<td><input type="text" name="cpf_cod" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Telefone<span style="color:red">*</span>: </td>
				<td><input type="text" name="telefone" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Estado<span style="color:red">*</span>: </td>
				<td>
					<select class="form-control">
					  <option value="0">Selecione seu Estado</option>
					  <option value="1">AC</option>
					  <option value="2">AL</option>
					  <option value="3">AP</option>
					  <option value="4">AM</option>
					  <option value="5">BA</option>
					  <option value="6">CE</option>
					  <option value="7">DF</option>
					  <option value="8">ES</option>
					  <option value="9">GO</option>
					  <option value="10">MA</option>
					  <option value="11">MT</option>
					  <option value="12">MS</option>
					  <option value="13">MG</option>
					  <option value="14">PA</option>
					  <option value="15">PB</option>
					  <option value="16">PR</option>
					  <option value="17">PE</option>
					  <option value="18">PI</option>
					  <option value="19">RJ</option>
					  <option value="20">RN</option>
					  <option value="21">RS</option>
					  <option value="22">RO</option>
					  <option value="23">RR</option>
					  <option value="24">SC</option>
					  <option value="25">SP</option>
					  <option value="26">SE</option>
					  <option value="27">TO</option>
					</select><br></td>
			</tr>
			<tr>
				<td>Cidade<span style="color:red">*</span>: </td>
				<td><input type="text" name="cidade" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Rua<span style="color:red">*</span>: </td>
				<td><input type="text" name="rua" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Bairro<span style="color:red">*</span>: </td>
				<td><input type="text" name="bairro" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Complemento:&nbsp&nbsp&nbsp<wsbr></td>
				<td><input type="text" name="complemento" class="form-control"><br></td>
			</tr>
			<tr>
				<td>Senha<span style="color:red">*</span>: </td>
				<td><input type="password" name="senha" class="form-control"><br></td>
			</tr>
		</table>
		<center><input type="submit" value="Enviar"></center>
	</form>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
