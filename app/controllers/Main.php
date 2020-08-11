<?
	class Main extends Controller {
		private $model;

		public function __construct() {
			$this->model = new MainModel();
		}

		public function get_content() {

			if($_POST['lo_submit']) {
				session_unset();
			}

			if($_POST['submit']) {
				$login = trim(strip_tags($_POST['login']));
				
				$reg = $this->model->CheckUserRegister($login);

				if(!$reg->num_rows) {
					$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

					$this->model->RegisterUser($login, $password);

					$result = $this->model->SelectUserInfo($login);
					$_SESSION['id'] = $result['id'];

					echo
						'<script>location.href= "?route=tasklist";</script>';
				}
				else {

					$user = $this->model->SelectUserInfo($login);

					if(password_verify($_POST['password'], $user['password'])) {
						$_SESSION['id'] = $user['id'];

						echo
							'<script>location.href= "?route=tasklist";</script>';
					}
					else 
						echo "<div class='bad-pass'>Вы ввели неверный пароль!</div>";
				}
			}
		}

	}
