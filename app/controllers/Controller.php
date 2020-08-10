<?
	abstract class Controller {
		protected $model;

		function __construct() {
			$this->model = new Model();
		}

		public function get_body($view) {
			$result = $this->get_content();
			include "app/views/$view.php";
		}

		abstract function get_content();
	}