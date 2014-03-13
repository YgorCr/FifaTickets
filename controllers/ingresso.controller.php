<?php

	require_once("models/ingresso.php");
	require_once("default.controller.php");

	class IngressoController extends DefaultController {

		private $table = "ingresso";

		public function all()
		{

			$res = $this->db->select($this->table);

			$ingressos = array();

			foreach ($res as $arr) {
				$ingresso = new Ingresso();
				foreach ($arr as $key => $value) {
					$ingresso->set($key, $value);
				}
				$ingressos[] = $ingresso;
			}

			return $ingressos;

		}

		public function byId(/* int */ $id)
		{
			$res = $this->db->select($this->table, "id='".$id."'");

			$ingressos = array();

			foreach ($res as $arr) {
				$ingresso = new Ingresso();
				foreach ($arr as $key => $value) {
					$ingresso->set($key, $value);
				}
				$ingressos[] = $ingresso;
			}

			return $ingressos[0];
		}

		public function byCompraId($compra_id)
		{
			$res = $this->db->select($this->table, "compra_id='".$compra_id."'");

			$ingressos = array();

			foreach ($res as $arr) {
				$ingresso = new Ingresso();
				foreach ($arr as $key => $value) {
					$ingresso->set($key, $value);
				}
				$ingressos[] = $ingresso;
			}

			return $ingressos;			
		}

		public function byCompra($compra)
		{
			return $this->byCompraId($compra->get("id"));
		}

		public function create($ingresso)
		{
			$all = $ingresso->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $ingresso->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert($this->table, $insert);

			$res = $this->db->run("SELECT CURRVAL('".$this->table."_id_seq');");

			$ingresso->set("id", $res[0]["currval"]);

			return $ingresso;

		}

		public function update($ingresso)
		{
			$all = $ingresso->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $ingresso->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update($this->table, $insert, "id='".$ingresso->get("id")."'");


		}

		public function delete($ingresso){
			return $this->db->delete($this->table, "id='".$ingresso->get("id")."'");

		}

	}


?>