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

$slide_id = filter_input(INPUT_POST, 'slide_id', FILTER_SANITIZE_URL);	
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
$position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_NUMBER_INT);
$active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT);

$query = "UPDATE ".DB_PREFIX."slider SET title = ?, content = ?, position = ?, url = ?, active = ? WHERE id = ? LIMIT 1"; 
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $title, PDO::PARAM_STR);
$stmt->bindParam(2, $content, PDO::PARAM_STR);
$stmt->bindParam(3, $position, PDO::PARAM_INT);
$stmt->bindParam(4, $url, PDO::PARAM_STR);
$stmt->bindParam(5, $active, PDO::PARAM_INT);
$stmt->bindParam(6, $slide_id, PDO::PARAM_INT);
$stmt->execute();

// SLIDE IMAGE
if($_FILES['image']['name'])
	{
	$f = $_FILES['image']['name'];
	$ext = strtolower(substr(strrchr($f, '.'), 1));
	if (($ext!= "jpg") && ($ext != "jpeg") && ($ext != "gif") && ($ext != "png")) 
		{		
		}

	else
		{
		$image_code = random_code();
		$image = $image_code."-".$_FILES['image']['name'];
		$image = RewriteFile($image);
		move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/temp/".$image);

		// create avatar image
		$resizeObj = new resize("../uploads/temp/".$image); 
		$resizeObj -> resizeImage(900, 450, 'crop'); // (options: exact, portrait, landscape, auto, crop) 
		$resizeObj -> saveImage("../uploads/images/".$image);
		
		@unlink ("../uploads/temp/".$image);
		$sql = "UPDATE ".DB_PREFIX."slider SET image = ? WHERE id = ? LIMIT 1"; 
		$conn->prepare($sql)->execute([$image, $slide_id]);
		}
	}

// form OK:
header("Location: ../account.php?page=pro-slider&msg=edit_ok");	
exit;