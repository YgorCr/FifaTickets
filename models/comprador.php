<?php
	echo "teste";
?>

<?php
	class Comprador {
		private $name;
		private $cpf_cod;
		private $telefone;
		private $rua;
		private $bairro;
		private $complemento;
		private $user;
		private $senha;

		public function get(/*string*/ attrName){
			return $this->$attrName;
		}

		public function set(attrName, attrValue){
			$this->$attrName = $attrValue;
		}
	}
?>
