<!DOCTYPE html>
<html>
	<head>
		<title>TaskList</title>
		<link rel="stylesheet" type="text/css" href="app/css/style.css">
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
			<div class="form tasks">
				<div class="task-name">Лист заданий:</div>
				<? if(!$result->num_rows): ?>
					На данный момент у вас нет задач!
				<? else: ?>
				<? while($fetch = $result->fetch_array()): ?>
				<div>
					<input type="radio" name="task" value='<?= $fetch['id'] ?>'>
					<label <? if($fetch['status']): echo "class='complete'"; endif; ?> ><?= $fetch['description'] ?></label>
				</div>
				<? endwhile; ?>
				<? endif; ?>
			</div>
		</form>
	</body>
</html>