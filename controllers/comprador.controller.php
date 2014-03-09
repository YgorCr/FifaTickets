<?php

	require_once("default.controller.php");
	require_once("models/comprador.php");

	class CompradorController extends DefaultController {


		public function all()
		{

			$compradores = $this->db->select("comprador");

			return $compradores;

		}

		public function byId(/* int */ $id)
		{
			$res = $this->db->select("comprador", "id='".$id."'");

			$compradores = array();

			foreach ($res as $arr) {
				$comp = new Comprador();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
					$compradores[] = $comp;
				}
			}

			return $compradores;
		}

		public function create($comprador)
		{
			$all = $comprador->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $comprador->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->insert('comprador', $insert);

		}

		public function update($comprador)
		{
			$all = $comprador->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $comprador->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update('comprador', $insert, "id='".$comprador->get("id")."'");


		}

	}

?>