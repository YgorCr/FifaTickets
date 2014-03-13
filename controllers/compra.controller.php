<?php

	require_once("default.controller.php");
	require_once("models/compra.php");
	
	class CompraController extends DefaultController{
		
		public function all(){

			$res = $this->db->select("compra");

			$compras = array();

			foreach ($res as $arr) {
				$comp = new Compra();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
				}
				$compras[] = $comp;
			}

			return $compras;
		}
		
		public function byId(/* int */ $id){
			$res = $this->db->select("compra", "id='".$id."'");

			$compras = array();

			foreach ($res as $arr) {
				$comp = new Compra();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
				}
				$compras[] = $comp;
			}

			return $compras[0];
		}

		public function byCompradorId($comprador_id){
			$res = $this->db->select("compra", "comprador_id='".$comprador_id."'");

			$compras = array();

			foreach ($res as $arr) {
				$comp = new Compra();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
				}
				$compras[] = $comp;
			}

			return $compras;
		}

		public function byComprador($comprador)
		{
			return $this->byCompradorId($comprador->get("id"));
		}
				
		public function create($compra){
			$all = $compra->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $compra->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert('compra', $insert);

			$res = $this->db->run("SELECT CURRVAL('compra_id_seq');");

			$compra->set("id", $res[0]["currval"]);

			return $compra;

		}

		public function update($compra){
			$all = $compra->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $compra->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update('compra', $insert, "id='".$compra->get("id")."'");

		}

		public function delete($compra){
			return $this->db->delete('compra', "id='".$compra->get("id")."'");

		}
	}

?>

