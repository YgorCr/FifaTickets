<?php

	class DefaultController {

		protected $db;

		public function __construct(/* FBD object */ $db)
		{
			$this->db = $db;
		}

	}

?>