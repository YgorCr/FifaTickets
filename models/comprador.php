<!-- *******TESTE********* -->
<?php
	$comp1 = new Comprador("ygor", 123, 1234, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "YgorCr", "123Cr");

	$all = $comp1->get("attr");
	$comp1->set("nome","mudou \o/");

	"nome".length();

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

			foreach ($args as $key => $value) {
				echo $key;
			}
			
			if($numArgs < 9){
				echo "ERROR: objetos comprador não aceitam campos nulos.";
			}
			else{
				$i = 0;
				foreach ($this->attr as &$attrName) {
					if(validaCampo($attrName, $args[$i])){
						$this->$attrName = $args[$i++];
					}
					else{
						throw new Exception(errorMsg($attrName), 1);
					}
				}
			}
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			if(validaCampo($attrName, $args[$i])){
				$this->$attrName = $attrValue;
			}
			else{
				throw new Exception(errorMsg($attrName), 1);
			}
		}

		private function errorMsg($attrName){
			switch ($attrName) {
				case 'nome':
					return 'O campo "Nome" é obrigatório. Por favor, tente novamente.'
					break;
				
				case 'cpf_cod':
					return 'O campo "CPF/Cod" deve é obrigatório e deve ser preenchido com no máximo 15 caracteres. Por favor, tente novamente.'
					break;
				
				case 'telefone':
					return 'O campo "telefone" deve ser preenchido apenas com números e ter entre 9 e 20 caracteres. Por favor, tente novamente.'
					break;
				
				case 'estado':
				case 'cidade':
				case 'bairro':
					return 'O campo "'.$attrName.'" é de preenchimento obrigatório e deve ter no máximo 20 caracteres. Por favor, tente novamente.'
					break;
								
				case 'rua':
					return 'O campo "'.$attrName.'" é de preenchimento obrigatório e deve ter no máximo 100 caracteres. Por favor, tente novamente.'
					break;

				case 'complemento':
					return 'O campo "'.$attrName.'" deve ter no máximo 300 caracteres. Por favor, tente novamente.'
					break;
			}
		}

		private function validaCampo($attrName, $attrValue){
			switch ($attrName) {
				case 'nome':
					return strlen($attrValue) > 0;
					break;
				
				case 'cpf_cod':
					return strlen($attrValue <= 15);
					break;
				
				case 'telefone':
					$attrValue = print_r($attrValue, true);
					$tam = strlen($attrValue);
					return is_numeric($attrValue) && $tam >=9 && $tam <= 20;
					break;
				
				case 'estado':
				case 'cidade':
				case 'bairro':
					$tam = strlen($attrValue);
					return tam <= 20 && tam > 0;
					break;
								
				case 'rua':
					$tam = strlen($attrValue);
					return tam <= 100 && tam > 0;
					break;

				case 'complemento':
					$tam = strlen($attrValue);
					return tam <= 300;
					break;

				case 'senha':
					return strlen($attrValue) == 32;
					break;
			}
		}
	}
?>
