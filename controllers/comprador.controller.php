<?php

	require_once("default.controller.php");
	require_once("models/comprador.php");

	class CompradorController extends DefaultController {


		public function all()
		{

			$res = $this->db->select("comprador");

			$compradores = array();

			foreach ($res as $arr) {
				$comp = new Comprador();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
				}
				$compradores[] = $comp;
			}

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
				}
				$compradores[] = $comp;
			}

			return $compradores[0];
		}

		public function tryLogin($cpf, $senha)
		{
			$md5 = md5($senha);

			$res = $this->db->run("SELECT * FROM comprador WHERE cpf_cod='".$cpf."' AND senha='".$md5."'");

			$compradores = array();

			foreach ($res as $arr) {
				$comp = new Comprador();
				foreach ($arr as $key => $value) {
					$comp->set($key, $value);
				}
				$compradores[] = $comp;
			}

			return $compradores[0];
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
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert('comprador', $insert);

			$res = $this->db->run("SELECT CURRVAL('comprador_id_seq');");

			$comprador->set("id", $res[0]["currval"]);

			return $comprador;

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

		public function delete($comprador){
			return $this->db->delete('comprador', "id='".$comprador->get("id")."'");

		}
	}

?>
