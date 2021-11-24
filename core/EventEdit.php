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
	$id_evento = filter_input(INPUT_POST, 'id_evento', FILTER_SANITIZE_STRING);
	$evento = filter_input(INPUT_POST, 'evento', FILTER_SANITIZE_STRING);
	$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
	$data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT);
	$hora = filter_input(INPUT_POST, 'hora', FILTER_DEFAULT);
	$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);
	$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);


// check for inputs
if($evento=="")
	{
	header("Location:../account.php?page=eventos&msg=error_evento");
	exit();
	}
	if($tipo=="")
	{
	header("Location:../account.php?page=eventos&msg=error_tipo");
	exit();
	}
	if($data=="" || $data < now())
	{
	header("Location:../account.php?page=eventos&msg=error_data");
	exit();
	}
	if($hora=="")
	{
	header("Location:../account.php?page=eventos&msg=error_hora");
	exit();
	}
	if($local=="")
	{
	header("Location:../account.php?page=eventos&msg=error_local");
	exit();
	}

$query = "UPDATE ".DB_PREFIX."evento SET evento = ?, data = ?, hora = ?, local = ?, endereco = ?, tipo = ? WHERE id_evento = ? LIMIT 1"; 
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $evento, PDO::PARAM_STR);
$stmt->bindParam(2, $data, PDO::PARAM_STR);
$stmt->bindParam(3, $hora, PDO::PARAM_STR);
$stmt->bindParam(4, $local, PDO::PARAM_STR);
$stmt->bindParam(5, $endereco, PDO::PARAM_STR);
$stmt->bindParam(6, $tipo, PDO::PARAM_STR);
$stmt->bindParam(7, $id_evento, PDO::PARAM_INT);
$stmt->execute();

// form OK:
header("Location: ../account.php?page=eventos&msg=edit_ok");	
exit;