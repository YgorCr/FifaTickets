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

			try {
				$res = $this->bd->execSql($sql, $values);
			} catch(Exception $e) {
				print_r($e->getMessage());
			}

			for($i=0;$i<count($res);$i++)
			{
				$robj = $res[$i];

				foreach ($robj as $key => $value) {
					$object = new $class();
					$object->set($key, $value);

					$objects[] = $object;
				}
			}

			return $objects;

		}

	}

?>