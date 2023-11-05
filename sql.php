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
			<input type="hidden" id="operacion" value="sql">
			<div class="col-12">
				<h1>SQL</h1>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-md-11">
				<input type="text" class="form-control" id="consulta">
			</div>
			<div class="col-md-1">
			<button type="submit" class="btn btn-primary" id="btnSQL" onclick="consulta(this.id)">Ejecutar</button>
			</div>
		</div>
		<div id="resultado" style="margin-top: 20px">
		</div>
	</div>
</body>

</html>