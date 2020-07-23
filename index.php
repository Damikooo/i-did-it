<?
include "db.php";
session_start();
if ($_POST["exit"]):
	session_destroy();
	header("Location: /");
endif;
// sign
if ($_POST['auth']):
	if (!$user_check):
		$user_add = $database->insert("users", [
			"login" => $_POST['login'],
			"password" => $_POST['password'],
			"created_at" => date("Y-m-d")
		]);
	endif;
	$user_check = $database->select("users", [
	"id"
	], [
		"login" => $_POST['login']
	]);
	$_SESSION['id'] = $user_check[0]['id'];
	header("Location: /");
endif;
if (($_POST['add']) or ($_POST['delete']) or ($_GET['clear'])):
	header("Location: /");
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Task list</title>
	<style type="text/css">
		.complete{
			color: green;
		}
	</style>
</head>
<body>
	<?
	if (isset($_SESSION['id'])):
		include "task.php";
	else:
		include "auth.php";
	endif;
	?>
</body>
</html>