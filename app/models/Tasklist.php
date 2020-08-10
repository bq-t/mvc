<?
	class Model {
		protected $mysql;

		public function __construct() {
			$this->mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		}

		public function AddTask($desc) {
			$query = $this->mysql->prepare("INSERT INTO `tasks` (`user_id`, `description`) VALUES (?, ?);");
			$query->bind_param('is', $_SESSION['id'], $desc);
			$query->execute();

			return $query->get_result();
		}

		public function DeleteTask($task_id)  {
			$query = $this->mysql->prepare("DELETE FROM `tasks` WHERE `id` = ?");
			$query->bind_param('i', $task_id);
			$query->execute();

			return $query->get_result();
		}

		public function CompleteTask($task_id) {
			$query = $this->mysql->prepare("UPDATE `tasks` SET `status` = '1' WHERE `id` = ?;");
			$query->bind_param('i', $task_id);
			$query->execute();

			return $query->get_result();
		}

		public function ClearTasks() {
			$query = $this->mysql->query("DELETE FROM `tasks` WHERE `user_id` = '$_SESSION[id]'");
			return $query;
		}

		public function GetTasks() {
			$query = $this->mysql->query("SELECT * FROM `tasks` WHERE `user_id` = '$_SESSION[id]'");
			return $query;
		}
	}