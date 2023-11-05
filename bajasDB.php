<?php
    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'farmacia';
    // Conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    }
    else{
        $tabla = $_POST['tabla'];
        $id = $_POST['id'];
        switch($tabla) {
            //Antes de borrar un registro, borramos las llaves foraneas a dicho registro
            case "producto":
                $bajasForaneas = "DELETE FROM comprar WHERE ProductoIdProducto=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM vender WHERE ProductoIdProducto=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM suministrar WHERE ProductoIdProducto=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'IdProducto';
                break;
            case "empleado":
                $bajasForaneas = "DELETE FROM atender WHERE EmpleadoIdEmpleado=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM vender WHERE EmpleadoIdEmpleado=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'IdEmpleado';
                break;
            case "cliente":
                $bajasForaneas = "DELETE FROM comprar WHERE ClienteIdCliente=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM atender WHERE ClienteIdCliente=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'IdCliente';
                break;
            case "proveedor":
                $bajasForaneas = "DELETE FROM suministrar WHERE ProveedorIdProveedor=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'IdProveedor';
                break;
        }
        $baja = "DELETE FROM $tabla WHERE $atributoId=$id;";
        $conexion -> query($baja);
        if ($conexion->affected_rows >= 1){ //revisamos que se inserto el registro
            echo "exito";
        }
        else {
            echo "error";
        }
    }              
?>