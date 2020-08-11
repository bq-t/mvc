<?
	class Model {
		public $mysql;

		public function __construct() {
			$this->mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		}
	}
