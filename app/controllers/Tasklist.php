<?
	class Tasklist extends Controller {
		private $model;

		public function __construct() {
			$this->model = new TasklistModel();
		}


		public function get_content() {
			if(!$_SESSION['id']) {
				header('Location: ./');
			}

			if($_POST['Add']) {
				if(!empty($_POST['TaskName'])) {
					$check = $this->model->CheckUserById($_SESSION['id']);

					if($check->num_rows) {
						$string = trim(strip_tags($_POST['TaskName']));

						$this->model->AddTask($string);
					}
					else
						echo "<div class='error'>Ошибка: Пользователь не найден!</div>";
				}
				else
					echo "<div class='error'>Ошибка: вы не указали задачу!</div>";
			}
			else if($_POST['Delete']) {
				if(count($_POST['task'])) {
					$this->model->DeleteTask($_POST['task']);
				}
				else
					echo "<div class='error'>Ошибка: вы не выбрали задачу из списка!</div>";
			}
			else if($_POST['Complete']) {
				if($_POST['task'] != null) {
					$this->model->CompleteTask($_POST['task']);
				}
				else
					echo "<div class='error'>Ошибка: вы не выбрали задачу из списка!</div>";
			}
			else if($_POST['Clear']) {
				$this->model->ClearTasks();
			}

			$result = $this->model->GetTasks();
			return $result;
		}

	}
