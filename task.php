<?
$task = $database->select("tasks", [
	"id",
	"description",
	"status"
],[
	"user_id" => $_SESSION['id']
]);

if ($_POST['add']):
	$task_add = $database->insert("tasks", [
		"user_id" => $_SESSION['id'],
		"description" => $_POST['description'],
		"created_at" => date("Y-m-d"),
		"status" => "active"
	]);
elseif ($_POST['delete']):
	$task_delete = $database->delete("tasks", [
		"user_id" => $_SESSION['id'] 
	]);
elseif ($_POST['mark']):
	$task_delete = $database->update("tasks", [
		"status" => "complete"
	],[
		"id" => $_POST['task']
	]);
elseif ($_GET['clear']):
	$task_add = $database->delete("tasks", [
		"id" => $_GET['clear'] 
	]);
endif;

?>
<form method="post">
	<input type="submit" name="exit" value="exit">
</form>
<form method="post">
	<input type="text" name="description">
	<input type="submit" name="add" value="Добавить">
	<input type="submit" name="delete" value="Очистить">
	<input type="submit" name="mark" value="Отметить как выполенно"><br>
<? foreach ($task as $k): ?>
	<input type="radio" name="task" value="<?=$k['id']?>"><span class="<?=$k['status']?>"><?=$k['description']?></span><a href="?clear=<?=$k['id']?>">Удалить</a></br>
<? endforeach; ?>
</form>