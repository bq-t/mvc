<? 
	session_start();

	if(!$_SESSION['id']) {
		header('Location: ./');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TaskList</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form method="POST">
			<div class="form manipulators">
				<input name="TaskName" placeholder="Введите именование задачи..">
				<div class="buttons">
					<input type="submit" name="Add" value="Добавить">
					<input type="submit" name="Delete" value="Убрать задание">
					<input type="submit" name="Complete" value="Отметить как выполненное">
					<input type="submit" name="Clear" value="Очистить список">
				</div>
			</div>
			<?
				include_once 'php/connect.php';

				if($_POST['Add']) {
					if(!empty($_POST['TaskName'])) {
						$query = $mysql->prepare("INSERT INTO `tasks` (`user_id`, `description`) VALUES (?, ?);");
						$query->bind_param('is', $_SESSION['id'], $_POST['TaskName']);
						$query->execute();
					}
					else
						echo "<div class='error'>Ошибка: вы не указали задачу!</div>";
				}
				else if($_POST['Delete']) {
					if(count($_POST['task'])) {
						$query = $mysql->prepare("DELETE FROM `tasks` WHERE `id` = ?");
						$query->bind_param('i', $_POST['task']);
						$query->execute();
					}
					else
						echo "<div class='error'>Ошибка: вы не выбрали задачу из списка!</div>";
				}
				else if($_POST['Complete']) {
					if($_POST['task'] != null) {
						$query = $mysql->prepare("UPDATE `tasks` SET `status` = '1' WHERE `id` = ?;");
						$query->bind_param('i', $_POST['task']);
						$query->execute();
					}
					else
						echo "<div class='error'>Ошибка: вы не выбрали задачу из списка!</div>";
				}
				else if($_POST['Clear']) {
					$mysql->query("DELETE FROM `tasks` WHERE `user_id` = '$_SESSION[id]'");
				}
			?>
			<div class="form tasks">
				<div class="task-name">Лист заданий:</div>
				<?
					$query = $mysql->query("SELECT * FROM `tasks` WHERE `user_id` = '$_SESSION[id]'");

					if(!$query->num_rows)
						echo "На данный момент у вас нет задач!";

					while($fetch = $query->fetch_array()):
				?>
				<div>
					<input type="radio" name="task" value='<?= $fetch['id'] ?>'>
					<label <? if($fetch['status']): echo "class='complete'"; endif; ?> ><?= $fetch['description'] ?></label>
				</div>
				<? endwhile; ?>
			</div>
		</form>
	</body>
</html>