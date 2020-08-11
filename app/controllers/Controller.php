<?
	abstract class Controller {
		protected $connect;

		function __construct() {
			$this->connect = new Model();
		}

		public function get_body($view) {
			$result = $this->get_content();
			include "app/views/$view.php";
		}

		abstract function get_content();
	}