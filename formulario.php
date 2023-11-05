<?php
    
    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'farmacia';
    
    if(isset($_POST['idTabla'])) {
        
        if($_POST['idTabla'] == "producto") {
            $cadena ='<h1>Producto</h1>
				<div class="row g-3">
					<div class="col-12">
						<label for="nombreProducto" class="form-label">Nombre:</label>
						<input required name="nombreProducto" type="text" class="form-control" id="nombreProducto">
					</div>
					<div class="col-12">
						<label for="marcaProducto" class="form-label">Marca:</label>
						<input required name="marcaProducto" type="text" class="form-control" id="marcaProducto">
					</div>
					<div class="col-12">
						<label for="costoProducto" class="form-label">Costo:</label>
						<input required name="costoProducto" type="number" class="form-control" id="costoProducto">
					</div>
					<div class="col-12">
						<label for="existenciaProducto" class="form-label">Existencia:</label>
						<input type="number" class="form-control" id="existenciaProducto" name="existenciaProducto"
							required>
					</div>';
            
                        // Conexion con la base de datos 
                        $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);

                        if($conexion->connect_error){
                            die('Ocurrio un error en la conexion con la BD');
                        }
                        else{
                            $sql = "SELECT IdProveedor,NombreProveedor FROM proveedor";
                            $res = $conexion->query($sql);
                            if($res->num_rows){
                                $cadena.='<div class="col-12" id="datosExtra"><label for="proveedores" class="form-label">Proveedores del Producto:</label><br>';
                                // Mostrar proveedores registrados
                                while($fila = $res->fetch_assoc()){
                                    $id = $fila['IdProveedor'];
                                    $nombre = $fila['NombreProveedor'];
                                    
                                    $cadena.='<div><input type="checkbox" id="proveedor" name="proveedor" value="'.$id.'" required><label style="margin-right:15px;font-size:18px;" for="proveedor">'.$nombre.'</label></div>'; 
                                }
								$cadena.='</div>';
                            }
                        }
                            
					$cadena.= '<div class="col-12" id="btn">
						<button class="btn btn-primary" onclick="altas()">Registrar</button>
					</div>
				</div>';
            
                echo $cadena;
        }
        else if($_POST['idTabla'] == "empleado") {
            echo '<h1>Empleado</h1>  
                <div class="row g-3">
					<div class="col-12">
						<label for="nombreEmpleado" class="form-label">Nombre:</label>
						<input required type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado">
					</div>
					<div class="col-12">
						<label for="edadEmpleado" class="form-label">Edad:</label>
						<input required type="number" class="form-control" id="edadEmpleado" name="edadEmpleado">
					</div>
					<div class="col-12">
						<label for="direccionEmpleado" class="form-label">Dirección:</label>
						<input required type="text" class="form-control" id="direccionEmpleado" name="direccionEmpleado">
					</div>
					<div class="col-12">
						<label for="telefonoEmpleado" class="form-label">Teléfono:</label>
						<input required type="number" class="form-control" id="telefonoEmpleado" name="telefonoEmpleado">
					</div>
					<div class="col-12">
						<label for="sueldoEmpleado" class="form-label">Sueldo:</label>
						<input required type="number" class="form-control" id="sueldoEmpleado" name="sueldoEmpleado">
					</div>
					<div class="col-12" id="btn">
						<button class="btn btn-primary" onclick="altas()">Registrar</button>
					</div>
                </div>';
        }
        else if($_POST['idTabla'] == "proveedor") {
            echo '<h1>Proveedor</h1> 
				<div class="row g-3">
					<div class="col-12">
						<label for="nombreProveedor" class="form-label">Nombre:</label>
						<input required name="nombreProveedor" type="text" class="form-control" id="nombreProveedor">
					</div>
					<div class="col-12">
						<label for="edadProveedor" class="form-label">Edad:</label>
						<input required name="edadProveedor" type="number" class="form-control" id="edadProveedor">
					</div>
					<div class="col-12">
						<label for="telefonoProveedor" class="form-label">Teléfono:</label>
						<input required name="telefonoProveedor" type="number" class="form-control" id="telefonoProveedor">
					</div>
					<div class="col-12">
						<label for="direccionProveedor" class="form-label">Dirección:</label>
						<input type="text" class="form-control" id="direccionProveedor" name="direccionProveedor" required>
					</div>
					<div class="col-12" id="btn">
						<button class="btn btn-primary" onclick="altas()">Registrar</button>
					</div>
				</div>';
        }
        else if($_POST['idTabla'] == "cliente") {
            
            $cadena='<h1>Cliente</h1>  
                <div class="row g-3">
					<div class="col-12">
						<label for="nombreCliente" class="form-label">Nombre:</label>
						<input required type="text" class="form-control" id="nombreCliente" name="nombreCliente">
					</div>
					<div class="col-12">
						<label for="edadCliente" class="form-label">Edad:</label>
						<input required type="number" class="form-control" id="edadCliente" name="edadCliente">
					</div>
					<div class="col-12">
						<label for="telefonoCliente" class="form-label">Telefono:</label>
						<input required type="number" class="form-control" id="telefonoCliente" name="telefonoCliente">
					</div>
					<div class="col-12">
						<label for="direccionCliente" class="form-label">Direccion:</label>
						<input required type="text" class="form-control" id="direccionCliente" name="direccionCliente">
					</div>';
            
			// Conexion con la base de datos 
			$conexion = new mysqli($serv,$cuenta,$contra,$BaseD);

			if($conexion->connect_error){
				die('Ocurrio un error en la conexion con la BD');
			}
			else{
				$sql = "SELECT IdProducto,NombreProducto FROM producto";
				$res = $conexion->query($sql);
				$cadena.='<div id="datosExtra">';
				if($res->num_rows){
					$cadena.='<div class="col-12"><label for="productos" class="form-label">Productos Comprados:</label><br>';
					//Mostrar productos
					while($fila = $res->fetch_assoc()){
						$id = $fila['IdProducto'];
						$nombre = $fila['NombreProducto'];

						$cadena.='<div><input type="checkbox" id="productos" name="productos" value="'.$id.'" required><label style="margin-right:15px;margin-bottom:10px;font-size:18px;" for="proveedor">'.$nombre.'</label></div>'; 
					}
					$cadena .= '</div>';
				}
					
				// Mostrar empleados
				$sql = "SELECT IdEmpleado,NombreEmpleado FROM empleado";
				$res = $conexion->query($sql);
				if($res->num_rows){
					$cadena.='<div class="col-12"><label for="empleado" class="form-label">Atendió Empleado:</label><br>';
					while($fila = $res->fetch_assoc()){
						$id = $fila['IdEmpleado'];
						$nombre = $fila['NombreEmpleado'];

						$cadena.='<div><input type="radio" id="'.$id.'" name="empleado" value="'.$id.'" required><label style="margin-bottom:10px;font-size:18px;" for="'.$id.'">'.$nombre.'</label><br></div>'; 
					}
					$cadena .= '</div>';
				}
				$cadena.='</div>';
			}
	
			$cadena.='<div class="col-12" id="btn">
					<button class="btn btn-primary" onclick="altas()">Registrar</button>	
				</div>
			</div>';
			echo $cadena;
        }
    }
?>