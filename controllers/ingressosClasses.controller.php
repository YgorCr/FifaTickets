<?php

	require_once("models/ingressosClasses.php");
	require_once("default.controller.php");

	class IngressosClassesController extends DefaultController {

		private $table = "ingressos_classes";

		public function all(){
			$res = $this->db->select($this->table);

			$ingressosClass = array();

			foreach ($res as $arr) {
				$ingressoClass = new IngressosClasses();
				foreach ($arr as $key => $value) {
					$ingressoClass->set($key, $value);
				}
				$ingressosClass[] = $ingressoClass;
			}

			return $ingressosClass;

		}

		public function byId(/* int */ $id){
			$res = $this->db->select($this->table, "id='".$id."'");

			$ingressosClass = array();

			foreach ($res as $arr) {
				$ingressoClass = new IngressosClasses();
				foreach ($arr as $key => $value) {
					$ingressoClass->set($key, $value);
				}
				$ingressosClass[] = $ingressoClass;
			}

			return $ingressosClass[0];
		}

		public function byPartida($partida)
		{
			return $this->byPartidaId($partida->get("id"));
		}

		public function byPartidaId($partida_id)
		{
			$res = $this->db->select($this->table, "partida_id='".$partida_id."'");

			$ingressosClass = array();

			foreach ($res as $arr) {
				$ingressoClass = new IngressosClasses();
				foreach ($arr as $key => $value) {
					$ingressoClass->set($key, $value);
				}
				$ingressosClass[] = $ingressoClass;
			}

			return $ingressosClass;

		}

		public function create($ingressoClass){
			$all = $ingressoClass->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $ingressoClass->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert($this->table, $insert);

			$res = $this->db->run("SELECT CURRVAL('".$this->table."_id_seq');");

			$ingressoClass->set("id", $res[0]["currval"]);

			return $ingressoClass;

		}

		public function update($ingressoClass){
			$all = $ingressoClass->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $ingressoClass->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update($this->table, $insert, "id='".$ingressoClass->get("id")."'");

		}

		public function delete($ingressoClass){
			return $this->db->delete($this->table, "id='".$ingressoClass->get("id")."'");
		}

	}

?>
