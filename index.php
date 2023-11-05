<?php
	include("header.php");
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Farmacia</title>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/estilosDBs.css">
</head>

<body>
	<div class="contenedorPrincipal">
		<div class="row g-3">
			<input type="hidden" id="operacion" value="altas">
			<div class="col-md-10">
				<h1>Altas</h1>
			</div>
			<div class="col-md-2"><?php include("menu.php"); ?></div>
		</div>
		<div class="row g-3">
			<div class="contenedor col-md-6" id="formulario">

			</div>
			<!-- <div class="col-md-6">

			</div> -->
		</div>
	</div>
</body>

</html>