<?php 
require_once "../config.php";
require_once ABSPATH."/core/checklogin.php";
require_once ABSPATH."/core/functions.php";
require_once ABSPATH."/core/resize-class.php";

if(DEMO_MODE!=0)
	{
	header("Location:../account.php?page=dashboard&msg=demo_mode");
	exit();
	}

	$sql = "SELECT  MONTHNAME(e.Data) AS MES, "
    . "COUNT(CASE WHEN ed.status = 'PRESENTE' THEN 1 END) AS PRESENTES, "
    . "COUNT(CASE WHEN ed.status = 'AUSENTE' THEN 1 END) AS AUSENTES "
    . "FROM evento e, evento_detalhe ed "
	. "WHERE e.id_evento = ed.id_evento AND YEAR(e.data) = YEAR(NOW()) "
    . "GROUP BY MONTH(e.data)"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
		$dados[] = $resultado;
	}
	echo json_encode($dados);
	exit;