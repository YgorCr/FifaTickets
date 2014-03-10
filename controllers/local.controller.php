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
					$locais[] = $loc;
				}
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
					$locais[] = $loc;
				}
			}
			return $locais[0];
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
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->insert('local', $insert);

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
