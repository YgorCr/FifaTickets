<?php

	require_once("default.controller.php");
	require_once("models/administrador.php");

	class AdministradorController extends DefaultController {


		public function all()
		{

			$res = $this->db->select("administrador");

			$administradores = array();

			foreach ($res as $arr) {
				$adm = new Administrador();
				foreach ($arr as $key => $value) {
					$adm->set($key, $value);
				}
				$administradores[] = $adm;
			}

			return $administradores;

		}

		public function byId(/* int */ $id)
		{
			$res = $this->db->select("administrador", "id='".$id."'");

			$administradores = array();

			foreach ($res as $arr) {
				$adm = new Administrador();
				foreach ($arr as $key => $value) {
					$adm->set($key, $value);
				}
				$administradores[] = $adm;
			}

			return $administradores[0];
		}

		public function tryLogin($cpf, $senha)
		{
			$md5 = md5($senha);

			$res = $this->db->run("SELECT * FROM administrador WHERE cpf_cod='".$cpf."' AND senha='".$md5."'");

			$administradores = array();

			foreach ($res as $arr) {
				$admin = new Administrador();
				foreach ($arr as $key => $value) {
					$admin->set($key, $value);
				}
				$administradores[] = $admin;
			}

			return $administradores[0];
		}

		public function create($administrador){
			$all = $administrador->get("attr");
			$values = array();
			
			foreach ($all as &$value) {
				$values[] = $administrador->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->insert('administrador', $insert);

		}

		public function update($administrador)
		{
			$all = $administrador->get("attr");
			$values = array();
			foreach ($all as &$value) {
				$values[] = $administrador->get($value);
			}

			$insert = array();
			for($i=0;$i<count($all);$i++){
				$insert[$all[$i]] = $values[$i];
			}

			return $this->db->update('administrador', $insert, "id='".$administrador->get("id")."'");

		}

		public function delete($administrador){
			return $this->db->delete('administrador', "id='".$administrador->get("id")."'");

		}
	}

?>
