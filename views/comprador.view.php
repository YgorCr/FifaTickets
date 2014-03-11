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

<div class="panel panel-default">
	<div class="panel-heading"><font size="5"><strong>Cadastro de usuários</strong></font></div>
	<div class="panel-body">
		<form>
			O campos marcados com <span style="color:red">*</span> são obrigatórios!<br><br>
			<table>
				<tr>
					<td class="tdlabel">Nome<span style="color:red">*</span>: </td>
					<td class="tdform"><input type="text" name="nome" class="form-control"></td>
				</tr>
				<tr>
					<td class="tdlabel">CPF/cod<span style="color:red">*</span>: </td>
					<td class="tdform"><input type="text" name="cpf_cod" class="form-control"></td>
				</tr>
				<tr>
					<td class="tdlabel">Telefone<span style="color:red">*</span>: </td>
					<td class="tdform"><input type="text" name="telefone" class="form-control"></td>
				</tr>
				<tr>
					<td class="tdlabel">Estado<span style="color:red">*</span>: </td>
					<td class="tdform">
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
					<td class="tdlabel">Complemento:&nbsp&nbsp&nbsp<wsbr></td>
					<td class="tdform"><input type="text" name="complemento" class="form-control"></td>
				</tr>
				<tr>
					<td class="tdlabel">Senha<span style="color:red">*</span>: </td>
					<td class="tdform"><input type="password" name="senha" class="form-control"></td>
				</tr>
			</table>
			<div>
				<center><input type="submit" value="Enviar"></center>
			</div>
		</form>
	</div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
