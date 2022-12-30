<?php session_start(); ?>


<?

//Controller
require_once("app/Controller/controller.php");


//Model
require_once("app/Model/DatabaseManager.php");


//Vue
require_once("app/View/view.php");

//Router
require_once("app/router.php");

?>

<?

$MYSQL_HOST = "127.0.0.1";
$MYSQL_PORT = "3306";
$MYSQL_DB = "heatmap";

$dsn = "mysql:host=" . $MYSQL_HOST . ";port=" . $MYSQL_PORT . ";dbname=" . $MYSQL_DB . ";charset=utf8";
$user = "heatmap";
$password = "heatmap";


$database = new DatabaseManager($dsn,$user,$password);


//require("app/Model/map.php");
$router = new Router($database);
$router->main();
?>