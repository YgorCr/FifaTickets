<?php
	/******* TESTE *********
	$comp1 = new Comprador(1,"ygor", 123456789, 123456789, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "12345678901234567890123456789012");

	$all = $comp1->get("attr");
	$comp1->set("nome","mudou \o/");

	$testValidation = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
	$errorValues = array(null, null, null, null, null, null, null, null, null, null);
	$rightValues = array(1, "ygor", 123456789, 123456789, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "12345678901234567890123456789012");
	foreach ($all as $key => $names) {
		$comp1->set($names, $testValidation[$key] ? ($errorValues[$key]) : ($rightValues[$key]) );
	}

	foreach ($all as &$value) {
		echo $comp1->get($value)."<br>";
	}
	/******* END TESTE *********/
?>

<?php
	class Comprador {
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

		private $attr = array("id", "nome", "cpf_cod", "telefone", "estado", "cidade", "rua", "bairro", "complemento", "senha");
		
		public function __construct(/* $id, $nome, $cpf_cod, $telefone, $estado, $cidade, $rua, $bairro, $complemento, $senha */){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs >= 10){
				foreach ($this->attr as $key => $attrName) {
					if(Comprador::validaCampo($attrName, $args[$key])){
						$this->$attrName = $args[$key];
					}
					else{
						throw new Exception(Comprador::errorMsg($attrName), 1);
					}
				}
			}
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			if(Comprador::validaCampo($attrName, $attrValue)){
				$this->$attrName = $attrValue;
			}
			else{
				throw new Exception(Comprador::errorMsg($attrName), 1);
			}
		}

		private static function validaCampo($attrName, $attrValue){
			$attrValue = print_r($attrValue, true);
			$tam = ( $attrValue ? strlen($attrValue) : 0 );

			switch ($attrName) {
				case 'id':
					return $tam != 0;

				case 'nome':
					return ($tam > 0);
					
				case 'cpf_cod':
					return ($tam <= 15 && $tam > 0);
					
				case 'telefone':
					return (is_numeric($attrValue) && ($tam >= 8 && $tam <= 20));
					
				case 'estado':
				case 'cidade':
				case 'bairro':
					return ($tam <= 20 && $tam > 0);
								
				case 'rua':
					return ($tam <= 100 && $tam > 0);
					
				case 'complemento':
					return ($tam <= 300);
					
				case 'senha':
					return ($tam == 32);

				case 'attr':
					return false;

				default:
					return "O atributo ".$attrName." não pertence a esta classe. Atributo desconhecido!";
			}
		}

		private static function errorMsg($attrName){
			switch ($attrName) {
				case 'attr':
					return 'O atributo attr não deve ser modificado. Somente leitura!';

				case 'nome':
					return 'O campo "Nome" é obrigatório. Por favor, tente novamente.';
					
				case 'cpf_cod':
					return 'O campo "CPF/Cod" é obrigatório e deve ser preenchido com no máximo 15 caracteres. Por favor, tente novamente.';
					
				case 'telefone':
					return 'O campo "telefone" deve ser preenchido apenas com números e ter entre 9 e 20 caracteres. Por favor, tente novamente.';
					
				case 'estado':
				case 'cidade':
				case 'bairro':
					return 'O campo "'.$attrName.'" é de preenchimento obrigatório e deve ter no máximo 20 caracteres. Por favor, tente novamente.';
								
				case 'rua':
					return 'O campo "'.$attrName.'" é de preenchimento obrigatório e deve ter no máximo 100 caracteres. Por favor, tente novamente.';
					
				case 'complemento':
					return 'O campo "'.$attrName.'" deve ter no máximo 300 caracteres. Por favor, tente novamente.';

				default:
					return "Erro de validação. Atributo com erro: ".$attrName;

			}
		}
	}
?>
