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
            case "producto": $atributoId = 'IdProducto'; break;
            case "empleado": $atributoId = 'IdEmpleado'; break;
            case "cliente": $atributoId = 'IdCliente'; break;
            case "proveedor": $atributoId = 'IdProveedor'; break;
        }
        $sql = "DESC $tabla;";
        $estructura = $conexion->query($sql);
        $atributos = array();
        if ($estructura->num_rows) {
            while ($fila = $estructura->fetch_assoc()) {
                array_push($atributos, $fila['Field']);
            }
            $sql = "SELECT * FROM $tabla WHERE $atributoId=$id;";
            $datos = $conexion->query($sql);
            $registro = array();
            if ($datos->num_rows) {
                $fila = $datos->fetch_assoc();
                for($i=0; $i<count($atributos); $i++) {
                    array_push($registro,$fila[$atributos[$i]]);
                }
                echo json_encode($registro);
            }
            else {

            }
        }
    }              
?>