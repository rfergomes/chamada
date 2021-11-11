<?php 
require_once "../config.php";
require_once ABSPATH."/core/checklogin.php";
require_once ABSPATH."/core/functions.php";

if(DEMO_MODE!=0)
	{
	header("Location:../account.php?page=dashboard&msg=demo_mode");
	exit();
	}

$id_evento = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = "DELETE FROM ".DB_PREFIX."evento WHERE id_evento = ?"; 
$conn->prepare($sql)->execute([$id_evento]);

header("Location: ../account.php?page=eventos&msg=delete_ok");
exit; 