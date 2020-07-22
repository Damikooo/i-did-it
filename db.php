<?
require  'Medoo.php';
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'tasklist',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 ])
?>