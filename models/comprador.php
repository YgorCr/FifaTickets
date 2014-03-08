<!-- *******TESTE********* -->
<?php
	$comp1 = new Comprador("ygor", 123456789, 1234456789, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "12345678901234567890123456789012");

	$all = $comp1->get("attr");
	$comp1->set("nome","mudou \o/");

	foreach ($all as &$value) {
		echo $comp1->get($value)."<br>";
	}
?>
<!-- ******* END TESTE********* -->

<?php
	class Comprador {
		private $nome;
		private $cpf_cod;
		private $telefone;
		private $estado;
		private $cidade;
		private $rua;
		private $bairro;
		private $complemento;
		private $senha;

		private $attr = array("nome", "cpf_cod", "telefone", "estado", "cidade", "rua", "bairro", "complemento", "senha");
		
		public function __construct($nome, $cpf_cod, $telefone, $rua, $bairro, $complemento, $user, $senha){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs < 9){
				echo "ERROR: objetos comprador não aceitam campos nulos.";
			}
			else{
				$i = 0;
				foreach ($this->attr as &$attrName) {
					if(Comprador::validaCampo($attrName, $args[$i])){
						$this->$attrName = $args[$i++];
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
			$tam = strlen($attrValue);

			switch ($attrName) {
				case 'nome':
					return ($tam > 0);
					
				case 'cpf_cod':
					return ($tam <= 15);
					
				case 'telefone':
					return (is_numeric($attrValue) && $tam >=9 && $tam <= 20);
					
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
			}
		}

		private static function errorMsg($attrName){
			switch ($attrName) {
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
				case 'senha':
					return "ERROR: Erro no campo senha.";
				default:
					return "Erro de validação.";

			}
		}
	}
?>
