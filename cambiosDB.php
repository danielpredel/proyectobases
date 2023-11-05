<?php
    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'farmacia';
    // Conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    $tabla = $_POST['tabla'];
    $id = $_POST['id'];
    switch($tabla) {
        case "producto": $atributoId = 'IdProducto'; break;
        case "empleado": $atributoId = 'IdEmpleado'; break;
        case "cliente": $atributoId = 'IdCliente'; break;
        case "proveedor": $atributoId = 'IdProveedor'; break;
    }
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    }
    else{
        switch($tabla) {
            case "producto":
                $nomProducto = $_POST['nombreProducto'];
                $marcaProducto = $_POST['marcaProducto'];
                $costoProducto = $_POST['costoProducto'];
                $existencia = $_POST['existenciaProducto'];
                $cambio = "UPDATE producto SET NombreProducto='$nomProducto', Marca='$marcaProducto', Costo=$costoProducto, Existencia=$existencia WHERE $atributoId=$id;";
                break;
            case "empleado":
                $NombreEmpleado = $_POST['nombreEmpleado'];
                $EdadEmpleado = $_POST['edadEmpleado'];
                $TelefonoEmpleado = $_POST['telefonoEmpleado'];
                $DireccionEmpleado = $_POST['direccionEmpleado'];
                $SueldoEmpleado = $_POST['sueldoEmpleado'];
                $cambio = "UPDATE empleado SET NombreEmpleado='$NombreEmpleado', EdadEmpleado=$EdadEmpleado, DireccionEmpleado='$DireccionEmpleado', TelefonoEmpleado=$TelefonoEmpleado, SueldoEmpleado=$SueldoEmpleado WHERE $atributoId=$id;";
                break;
            case "cliente":
                $nombreCliente = $_POST['nombreCliente'];
                $edadCliente = $_POST['edadCliente'];
                $telefonoCliente = $_POST['telefonoCliente'];
                $direccionCliente = $_POST['direccionCliente'];
                $cambio= "UPDATE cliente SET NombreCliente='$nombreCliente', EdadCliente=$edadCliente, TelefonoCliente=$telefonoCliente, DireccionCliente='$direccionCliente' WHERE $atributoId=$id;";
                break;
            case "proveedor":
                $nomProveedor = $_POST['nombreProveedor'];
                $edadProveedor = $_POST['edadProveedor'];
                $telProveedor = $_POST['telefonoProveedor'];
                $direccion = $_POST['direccionProveedor'];
                $cambio = "UPDATE proveedor SET NombreProveedor='$nomProveedor', EdadProveedor=$edadProveedor, TelefonoProveedor=$telProveedor, DireccionProveedor='$direccion' WHERE $atributoId=$id;";
                break;
        }
        $conexion -> query($cambio);
        if ($conexion->affected_rows >= 1){ //revisamos que se inserto el registro
            echo "exito";
        }
        else {
            echo "error";
        }
    }              
?>