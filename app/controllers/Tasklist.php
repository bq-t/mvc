<?
	class Tasklist extends Controller {
		public function get_content() {
			if(!$_SESSION['id']) {
				header('Location: ./');
			}

			if($_POST['Add']) {
				if(!empty($_POST['TaskName'])) {
					$this->model->AddTask($_POST['TaskName']);
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
