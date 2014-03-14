<?php
	class Administrador {
		private $id;
		private $nome;
		private $cpf_cod;
		private $senha;

		private $attr = array("id", "nome", "cpf_cod", "senha");
		
		public function __construct(/*$id, $nome, $cpf_cod, $senha*/){
			$args = func_get_args();
			$numArgs = func_num_args();

			if($numArgs >= 10){
				foreach ($this->attr as $key => $attrName) {
					if(Administrador::validaCampo($attrName, $args[$key])){
						$this->$attrName = $args[$key];
					}
					else{
						throw new Exception(Administrador::errorMsg($attrName), 1);
					}
				}
			}
		}

		public function get(/*string*/ $attrName){
			return $this->$attrName;
		}

		public function set($attrName, $attrValue){
			if(Administrador::validaCampo($attrName, $attrValue)){
				$this->$attrName = $attrValue;
			}
			else{
				throw new Exception(Administrador::errorMsg($attrName), 1);
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
					
				case 'senha':
					return ($tam == 32);

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
					
				case 'cpf_cod':
					return 'O campo "CPF/Cod" é obrigatório e deve ser preenchido com no máximo 15 caracteres. Por favor, tente novamente.';
					
				default:
					return "Erro de validação. Atributo com erro: ".$attrName;

			}
		}
	}
?>
