<!DOCTYPE html>
<html>
	<head>
		<title>TaskList</title>
		<link rel="stylesheet" type="text/css" href="app/css/style.css">
	</head>
	<body>
		<? if(!$_SESSION['id']): ?>
		<form class="form login" method="POST">
			<input name="login" placeholder="Введите логин.." required>
			<input type="password" name="password" placeholder="Введите пароль.." required>
			<input type="submit" name="submit" value="Войти / Зарегистрироваться">
		</form>
		<? else: ?>
		<form class="form login" method="POST">
			<div>Вы уже авторизованы, хотите выйти?</div>
			<input type="submit" name="lo_submit" value="Выйти">
		</form>
		<? endif; ?>
	</body>
</html>