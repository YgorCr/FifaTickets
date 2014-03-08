<?php

	class DefaultController {

		protected $bd;

		public function __construct(/* FBD object */ $bd)
		{
			$this->bd = $bd;
		}

		public function generic(/* string */ $sql, /* mixed array */ $values, /* class name */ $class)
		{
			$objects = array();

			$res = $bd->execSql($sql, $values);

			foreach ($res as $key => $value) {
				$object = new $class();
				$object->set($key, $value);

				$objects[] = $object;
			}

			return $objects;

		}

	}

?>