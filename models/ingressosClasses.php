<?php
	/******* TESTE *********
	$comp1 = new Comprador(1,"ygor", 123456789, 123456789, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "12345678901234567890123456789012");

	$all = $comp1->get("attr");
	$comp1->set("nome","mudou \o/");

	$testValidation = array(0, 0, 0, 0, 0, 0, 0, 0, 1, 0);
	$errorValues = array(null, null, null, null, null, null, null, null, null, null);
	$rightValues = array(1,"ygor", 123456789, 123456789, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "12345678901234567890123456789012");
	foreach ($all as $key => $names) {
		$comp1->set($names, $testValidation[$key] ? ($errorValues[$key]) : ($rightValues[$key]) );
	}

	foreach ($all as &$value) {
		echo $comp1->get($value)."<br>";
	}	
	/******* END TESTE *********/
?>

<?php
	class IngressosClasses {
		private $id;
		private $nome;
		private $total;
		private $vendidos;
		private $valor;
		private $partida_id;

		private $attr = array("id", "nome", "total", "vendidos", "valor", "partida_id");
		
		public function __construct(/* $id, $nome, $total, $vendidos, $valor, $partida_id */){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs >= 6){
				foreach ($this->attr as $key => $attrName) {
					if(IngressosClasses::validaCampo($attrName, $args[$key])){
						$this->$attrName = $args[$key];
					}
					else{
						throw new Exception(IngressosClasses::errorMsg($attrName), 1);
					}
				}
			}
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			if(IngressosClasses::validaCampo($attrName, $attrValue)){
				$this->$attrName = $attrValue;
			}
			else{
				throw new Exception(IngressosClasses::errorMsg($attrName), 1);
			}
		}

		private static function validaCampo($attrName, $attrValue){
			$attrValue = print_r($attrValue, true);
			$tam = strlen($attrValue);

			switch ($attrName) {
				case 'id':
					return $tam != 0;

				case 'nome':
					return ($tam > 0 && $tam <= 30);
					
				case 'total':
					return ((int)$attrValue) >= 0;
				
				case 'vendidos':
					return ((int)$attrValue) >= 0;			

				case 'valor':
					return ((int)$attrValue) >= 0;

				case 'partida_id':
					return (is_numeric($attrValue));

				case 'attr':
					return false;

				default:
					throw new Exception("O atributo ".$attrName." não pertence a esta classe. Atributo desconhecido!", 1);
					
			}
		}

		private static function errorMsg($attrName){
			switch ($attrName) {
				case 'attr':
					return 'O atributo attr não deve ser modificado. Somente leitura!';

				case 'nome':
					return 'O campo "Nome" é obrigatório. Por favor, tente novamente.';
				
				case 'total':
				case 'vendidos':
				case 'valor':
					return 'Valor inválido para o campo "'.$attrName.'".';

				default:
					return "Erro de validação. Atributo com erro: ".$attrName;

			}
		}
	}
?>
