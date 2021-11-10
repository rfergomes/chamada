<?php 
require_once "../config.php";
require_once ABSPATH."/core/checklogin.php";
require_once ABSPATH."/core/functions.php";
require_once ABSPATH."/core/PasswordHash.php";
require_once ABSPATH."/core/resize-class.php";

if(DEMO_MODE!=0)
	{
	header("Location:../account.php?page=dashboard&msg=demo_mode");
	exit();
	}

$evento = filter_input(INPUT_POST, 'evento', FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT);
$hora = filter_input(INPUT_POST, 'hora', FILTER_DEFAULT);
$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);

// check for inputs
if($evento=="")
	{
	header("Location:../account.php?page=pro-users&msg=error_evento");
	exit();
	}
	if($tipo=="")
	{
	header("Location:../account.php?page=pro-users&msg=error_tipo");
	exit();
	}
	if($data=="")
	{
	header("Location:../account.php?page=pro-users&msg=error_data");
	exit();
	}
	if($hora=="")
	{
	header("Location:../account.php?page=pro-users&msg=error_hora");
	exit();
	}
	if($local=="")
	{
	header("Location:../account.php?page=pro-users&msg=error_local");
	exit();
	}
	
$query = "INSERT INTO ".DB_PREFIX."evento (evento, data, hora, local, endereco, tipo) VALUES (?,?,?,?,?,?)"; 
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $evento, PDO::PARAM_STR);
$stmt->bindParam(2, $tipo, PDO::PARAM_STR);
$stmt->bindParam(3, $data, PDO::PARAM_STR);
$stmt->bindParam(4, $hora, PDO::PARAM_STR);
$stmt->bindParam(5, $local, PDO::PARAM_INT);
$stmt->bindParam(6, $endereco, PDO::PARAM_INT);
$stmt->execute();

$id_evento = $conn->lastInsertId(); // last inserted ID
	
// form OK:
header("Location: ../account.php?page=eventos&msg=add_ok");	
exit;