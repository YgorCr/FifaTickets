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

		private $attr = array("name", "cpf_cod", "telefone", "rua", "bairro", "complemento", "user", "senha");
		
		public function __construct(/*name, cpf_cod, telefone, rua, bairro, complemento, user, senha*/){
			$args = func_get_args();
			$numArgs = func_num_args();
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			$this->$attrName = $attrValue;
		}
	}
?>
