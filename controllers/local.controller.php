<?php

	require_once("default.controller.php");
	require_once("models/local.php");
	
	class LocalController extends DefaultController {


		public function all(){

			$res = $this->db->select("local");

			$locais = array();

			foreach ($res as $arr) {
				$loc = new Local();
				foreach ($arr as $key => $value) {
					$loc->set($key, $value);
				}
				$locais[] = $loc;
			}

			return $locais;
		}
		
		public function byId(/* int */ $id){
			$res = $this->db->select("local", "id='".$id."'");

			$locais = array();

			foreach ($res as $arr) {
				$loc = new Local();
				foreach ($arr as $key => $value) {
					$loc->set($key, $value);
				}
				$locais[] = $loc;
			}
			return $locais[0];
		}
		
		public function byNome($nome)
		{
			$locais = array();

			$bind = array(
			    ":search" => "%$nome%"
			);
			$res = $this->db->select("local", "nome LIKE :search", $bind);

			foreach ($res as $arr) {
				$local = new Local();
				foreach ($arr as $key => $value) {
					$local->set($key, $value);
				}
				$locais[] = $local;
			}

			return $locais;

		}

		public function create($local){
			
			$all = $local->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $local->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++)
			{
				if($all[$i]=="id") continue;
				$insert[$all[$i]] = $values[$i];
			}

			$this->db->insert('local', $insert);

			$res = $this->db->run("SELECT CURRVAL('local_id_seq');");

			$local->set("id", $res[0]["currval"]);

			return $local;

		}

		public function update($local){
			$all = $local->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $local->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update('local', $insert, "id='".$local->get("id")."'");

		}
		
		public function delete($local){
			return $this->db->delete('local', "id='".$local->get("id")."'");

		}
		
		// E isso aqui?
		// return $this->db->update('local', $insert, "id='".$local->get("id")."'");
	}

?>
