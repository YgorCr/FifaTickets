<script>
	function formatar(mascara, documento){
		var i = documento.value.length;
		var saida = mascara.substring(0,1);
		var texto = mascara.substring(i)

		if(i == 2){
			documento.value += " ";
		}else if (texto.substring(0,1) != saida){
			documento.value += texto.substring(0,1);
		}
	}
	function cleanMe()
	{
		$(".form-control").val("");
		$("#estado").val(0);
	}
</script>

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

<?php

	if($comprador)
	{
		header("location:?a=me");
	}

	if(isset($_GET["post"]))
	{
		if(  isset($_POST["nome"])     && (!strlen($_POST["nome"])   || !strlen($_POST["cpf_cod"]) ||
			!strlen($_POST["telefone"]) || !strlen($_POST["estado"]) || !strlen($_POST["cidade"] ) ||
			!strlen($_POST["rua"])      || !strlen($_POST["bairro"]) || !strlen($_POST["senha"]  )))
		{
			$ERROR = '<div class="panel panel-default">
						<div class="panel-body" style = "background-color: #DDDDCC" ><font color="red">';
			foreach ($_POST as $key => $value) {
				if(!strlen($_POST[$key])){
					$ERROR = $ERROR.'O campo '.$key.' é obrigatório. Por favor, tente novamente.<br>';
				}
			}
			$ERROR = $ERROR.'</font></div></div>';
		}
		else
		{
			/* *
			foreach ($_POST as $key => $value)
			{
				echo $key." = '".$value."' length = ".strlen($value)."<br>";		
			}
			/* */

			$compradorCtrl = new CompradorController($db);
			$novoComprador = new Comprador();
			foreach ($_POST as $key => $value) {
				if($key=="telefone")
				{
					$value = str_replace(" ", "", $value);
					$value = str_replace("-", "", $value);
				} else if($key=="senha") {
					$value = md5($value);
				}

				$novoComprador->set($key, $value);
			}

			$novoComprador = $compradorCtrl->create($novoComprador);

			header("location:?a=comprador.login");

		}
	}
?>

<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<div class="panel panel-default">
	<div class="panel-heading">Cadastro de usuários</div>
	<div class="panel-body">
		<form method = "post" action="index.php?a=comprador&post">
			<?php
				if(strlen($ERROR)){
					echo $ERROR;
				}
			?>
			O campos marcados com <span style="color:red">*</span> são obrigatórios!<br>
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
					<td class="tdform"><input type="text" maxlength="12" name="telefone" class="form-control" OnKeyPress="formatar('## ####-####', this)"></td>
				</tr>
				<tr>
					<td class="tdlabel">Estado<span style="color:red">*</span>: </td>
					<td class="tdform">
						<select class="form-control" name="estado" id="estado">
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
					<td class="tdlabel">Complemento:&nbsp&nbsp&nbsp<wsbr></td>
					<td class="tdform"><input type="text" name="complemento" class="form-control"></td>
				</tr>
				<tr>
					<td class="tdlabel">Senha<span style="color:red">*</span>: </td>
					<td class="tdform"><input type="password" name="senha" class="form-control"></td>
				</tr>
			</table>
			<br>
			<div class="btn-group" style="margin-left: 78px">
			  <button type="button" class="btn btn-default" onclick="javascript:cleanMe();">Cancelar</button>
			  <button type="submit" class="btn btn-default">Enviar</button>
			</div>
		</form>
	</div>
</div>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
