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

$id_evento = filter_input(INPUT_POST, 'e', FILTER_SANITIZE_STRING);
$id_usuario = filter_input(INPUT_POST, 'u', FILTER_SANITIZE_STRING);

// check for inputs
if($id_evento =="" || $id_usuario =="")
	{
	header("Location:../account.php?page=evento_detalhe&id=".$id_evento."&msg=erro");
	exit();
	}

	$sql = "DELETE FROM ".DB_PREFIX."evento_detalhe WHERE id_evento = ? AND id_usuario = ?"; 
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(1, $id_evento, PDO::PARAM_STR);
	$stmt->bindParam(2, $id_usuario, PDO::PARAM_STR);
	$stmt->execute();

// form OK:
	header("Location:../account.php?page=evento_detalhe&id=".$id_evento."&msg=delete_ok");	
exit;