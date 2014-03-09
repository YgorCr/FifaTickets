<!-- *******TESTE********* -->
<?php
	$comp1 = new Compra(1, 12031994, "Boleto Bancário", 1);

	$all = $comp1->get("attr");
	$comp1->set("data","mudou \o/");

	foreach ($all as &$value) {
		echo $comp1->get($value)."<br>";
	}
?>
<!-- ******* END TESTE********* -->

<?php
	class Compra {
		private $id;
		private $data;
		private $forma_de_pagamento;
		private $comprador_id;

		private $attr = array("id", "data", "forma_de_pagamento", "comprador_id");
		
		public function __construct($id ,$data, $forma_de_pagamento, $comprador_id){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs < 4){
				echo "ERROR: objetos compra não aceitam campos nulos.";
			}
			else{
				foreach ($this->attr as $key => $attrName) {
					if(Comprador::validaCampo($attrName, $args[$key])){
						$this->$attrName = $args[$key];
					}
					else{
						throw new Exception(Compra::errorMsg($attrName), 1);
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
				case 'id':
					return (is_numeric($attrValue));

				case 'comprador_id':
					return (is_numeric($attrValue));

				default:
					return 1;
			}
		}

		private static function errorMsg($attrName){
			switch ($attrName) {
				case 'data':
					return 'O campo "'.$attrName.'" é obrigatório. Por favor, tente novamente.';

				case 'forma_de_pagamento':
					return 'O campo "'.$attrName.'" é obrigatório. Por favor, tente novamente.';
				
				default:
					return "Erro de validação.";

			}
		}
	}
?>
