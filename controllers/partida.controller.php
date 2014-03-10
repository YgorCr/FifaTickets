<?php

	require_once("models/partida.php");
	require_once("default.controller.php");

	class PartidaController extends DefaultController {

		private $table = "partida";

		public function all()
		{

			$res = $this->db->select($this->table);

			$partidas = array();

			foreach ($res as $arr) {
				$part = new Partida();
				foreach ($arr as $key => $value) {
					$part->set($key, $value);
				}
				$partidas[] = $part;
			}

			return $partidas;

		}

		public function byId(/* int */ $id)
		{
			$res = $this->db->select($this->table, "id='".$id."'");

			$partidas = array();

			foreach ($res as $arr) {
				$part = new Partida();
				foreach ($arr as $key => $value) {
					$part->set($key, $value);
				}
				$partidas[] = $part;
			}

			return $partidas[0];
		}

		public function create($partida)
		{
			$all = $partida->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $partida->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->insert($this->table, $insert);

		}

		public function update($partida)
		{
			$all = $partida->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $partida->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update($this->table, $insert, "id='".$partida->get("id")."'");


		}

		public function delete($partida){
			return $this->db->delete('partida', "id='".$partida->get("id")."'");

		}
	}


?>
