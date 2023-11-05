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
			<input type="hidden" id="operacion" value="edicion">
			<input type="hidden" id="menuTabla" value="<?php echo $_POST['tabla']; ?>">
			<input type="hidden" id="id" value="<?php echo $_POST['id']; ?>">

			<div class="col-md-10"><h1>Editar Registro</h1></div>
		</div>
		<div class="contenedor" id="formulario">

		</div>
	</div>
</body>
</html>