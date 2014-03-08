<?php
	$comp1 = new Comprador("ygor", 123, 1234, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "YgorCr", "123Cr");

	$all = $comp1->get("attr");
	$comp1->set("nome","mudou \o/");

	foreach ($all as &$value) {
		echo $comp1->get($value)."<br>";
	}
 ?>

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
		
		public function __construct(/*nome, cpf_cod, telefone, rua, bairro, complemento, user, senha*/){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs < 9){
				echo "ERROR: objetos comprador não aceitam campos nulos.";
			}
			else{
				$i = 0;
				foreach ($this->attr as &$name) {
					$this->$name = $args[$i++];
				}
			}
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			$this->$attrName = $attrValue;
		}
	}
?>
