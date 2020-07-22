<?
include "db.php";
session_start();
if ($_POST["exit"]):
	session_destroy();
	header("Location: /");
endif;
// sign
$user_check = $database->select("users", [
	"id",
	"login"
], [
	"login" => $_POST['login']
]);
if ($_POST['auth']):
	if (!$user_check):
		$user_add = $database->insert("users", [
			"login" => $_POST['login'],
			"password" => $_POST['password'],
			"created_at" => date("d-m-Y")
		]);
	endif;
	$_SESSION['login'] = $_POST['login'];
	header("Location: /");
endif;
if (($_POST['add']) or ($_POST['delete']) or ($_GET['clear'])):
	header("Location: /");
endif;
//auth

print_r ($task);
//task
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
	if (isset($_SESSION['login'])):
		include "task.php";
	else:
		include "auth.php";
	endif;
	?>
</body>
</html>