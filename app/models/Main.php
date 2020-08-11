<?
	class MainModel extends Model {

		public function CheckUserRegister($login) {
			$query = $this->mysql->prepare("SELECT * FROM `users` WHERE `login` = ?");
			$query->bind_param('s', $login);
			$query->execute();
			$result = $query->get_result();

			return $result;
		}

		public function RegisterUser($login, $password) {
			$reg = $this->mysql->prepare("INSERT INTO `users` (`login`, `password`) VALUES (? , ?);");
			$reg->bind_param('ss', $login, $password);
			$reg->execute();
			$result = $reg->get_result();

			return $result;
		}

		public function SelectUserInfo($login) {
			$id = $this->mysql->prepare("SELECT * FROM `users` WHERE `login` = ?");
			$id->bind_param('s', $login);
			$id->execute();
			$result = $id->get_result();

			return $result->fetch_array();
		}

	}