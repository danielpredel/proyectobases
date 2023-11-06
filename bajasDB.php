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
            case "Producto":
                $bajasForaneas = "DELETE FROM Producto_Venta WHERE Producto_idProducto=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM Producto_Proveedor WHERE Producto_idProducto=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM Producto_Pedido WHERE Producto_idPedido=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'IdProducto';
                break;
            case "Empleado":
                $bajasForaneas = "DELETE FROM Venta WHERE Empleado_idEmpleado=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'idEmpleado';
                break;
            case "Cliente":
                $bajasForaneas = "DELETE FROM Venta WHERE Cliente_idCliente=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM Consultar WHERE Cliente_idCliente=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'idCliente';
                break;
            case "Proveedor":
                $bajasForaneas = "DELETE FROM Producto_Proveedor WHERE Proveedor_idProveedor=$id;";
                $conexion -> query($bajasForaneas);
                $bajasForaneas = "DELETE FROM Pedido WHERE Proveedor_idProveedor=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'idProveedor';
                break;
            case "Doctor":
                $bajasForaneas = "DELETE FROM Consultar WHERE Doctor_idDoctor=$id;";
                $conexion -> query($bajasForaneas);
                $atributoId = 'idDoctor';
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