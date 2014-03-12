<?php

	require_once("models/partida.php");
	require_once("default.controller.php");

	class PartidaController extends DefaultController {

		private $table = "partida";

		public function all($limit)
		{

			$partidas = array();

			if(isset($limit) && $limit>0)
			{

				$res = $this->db->run("SELECT * FROM ".$this->table." LIMIT $limit");

			} else {

				$res = $this->db->select($this->table);

			}

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

		public function proximasPartidas($data, $limit)
		{
			$partidas = array();

			$sql = "SELECT * FROM ".$this->table." WHERE data>='".$data."'";
			
			if (isset($limit)) {
				$sql = $sql." LIMIT $limit";
			}
			
			
			$res = $this->db->run($sql);

			foreach ($res as $arr) {
				$part = new Partida();
				foreach ($arr as $key => $value) {
					$part->set($key, $value);
				}
				$partidas[] = $part;
			}

			return $partidas;
		}

		public function byNome($nome)
		{
			$bind = array(
			    ":search" => "%$nome%"
			);
			$res = $this->db->select($this->table, "nome LIKE :search", $bind);

			foreach ($res as $arr) {
				$part = new Partida();
				foreach ($arr as $key => $value) {
					$part->set($key, $value);
				}
				$partidas[] = $part;
			}

			return $partidas;

		}

		public function byData($data)
		{
			$bind = array(
			    ":search" => "$data"
			);
			$res = $this->db->select($this->table, "data = :search", $bind);

			foreach ($res as $arr) {
				$part = new Partida();
				foreach ($arr as $key => $value) {
					$part->set($key, $value);
				}
				$partidas[] = $part;
			}

			return $partidas;

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
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert($this->table, $insert);

			$res = $this->db->run("SELECT CURRVAL('".$this->table."_id_seq');");

			$partida->set("id", $res[0]["currval"]);

			return $partida;

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
