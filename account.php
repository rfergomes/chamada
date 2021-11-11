<?php
/*==============================================
|| ############################################# 
|| Copyright Pike Admin - www.pikeadmin.com
|| ############################################# 
==============================================*/
session_start();
require("config.php");
require_once ABSPATH . "/core/checklogin.php";
require_once ABSPATH . "/core/functions.php";
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
if (!$page) $page = 'dashboard';
$msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
$pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Controle de Frequências</title>
	<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
	<meta name="keywords" content="Bootstrap 4, admin, theme, template, pike admin">
	<?php include("global-head.php"); ?>
</head>

<body class="adminbody">

	<div id="main">

		<?php include("navigation.php"); ?>

		<?php include("sidebar.php"); ?>

		<div class="content-page">

			<!-- Start content -->
			<div class="content">

				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12">
							<div class="breadcrumb-holder">
								<h1 class="main-title float-left"><?= ucfirst($page) ?></h1>
								<ol class="breadcrumb float-right">
									<li class="breadcrumb-item">Home</li>
									<li class="breadcrumb-item active"><?= ucfirst($page) ?></li>
								</ol>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<?php
					// ADMIN pages
					switch ($page) {

						case $page:
							if (!file_exists("views/" . $page . ".php")){
								include ("views/404.php");
							}else{
								include("views/" . $page . ".php");
							}							
							break;
						default:
							include("views/dashboard.php");
							break;
					}
					?>

				</div>
				<!-- END container-fluid -->

			</div>
			<!-- END content -->

		</div>
		<!-- END content-page -->

		<?php include("footer.php"); ?>

	</div>
	<!-- END main -->

	<?php include("global-footer.php"); ?>

</body>

</html>