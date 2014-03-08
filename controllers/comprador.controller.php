<?php

	require_once("default.controller.php");
	require_once("models/comprador.php");

	class CompradorController extends DefaultController {

		public function all()
		{

			$compradores = $this->generic("SELECT * FROM comprador", array(), 'Comprador');

			return $compradores;

		}

		public function byId(/* int */ $id)
		{
			$compradores = $this->generic("SELECT * FROM comprador WHERE id=?", array($id), 'Comprador');

			return $compradores;
		}

	}

?>