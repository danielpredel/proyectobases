<?php
    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'farmacia';
    // Conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    $tabla = $_POST['tabla'];

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
                $alta = "INSERT INTO producto (NombreProducto, Marca, Costo, Existencia) VALUES ('$nomProducto', '$marcaProducto', '$costoProducto', '$existencia')";
                $proveedores = $_POST['proveedores'];  // id proveedores
                $idProveedores = getArray($proveedores); // Meter proveedores a Array
                
                // Dar de alta al nuevo producto
                $conexion->query($alta);
                
                //Recuperar el id del producto nuevo
                $sql = "SELECT IdProducto FROM producto WHERE NombreProducto LIKE BINARY '$nomProducto'";
                $res = $conexion->query($sql);
                $fila = $res->fetch_assoc();
                $id = $fila['IdProducto'];
                
                // Insertar en la tabla de Suministrar
                foreach($idProveedores as $idProv){
                    $sql = "INSERT INTO suministrar VALUES (".$id.",".$idProv.")";
                    $conexion->query($sql);
                }
                
                if ($conexion->affected_rows >= 1){ //revisamos que se insertaron registros
                    echo "exito";
                }
                else {
                    echo "error";
                }
                
                break;
                
            case "empleado":
                
                $NombreEmpleado = $_POST['nombreEmpleado'];
                $EdadEmpleado = $_POST['edadEmpleado'];
                $TelefonoEmpleado = $_POST['telefonoEmpleado'];
                $DireccionEmpleado = $_POST['direccionEmpleado'];
                $SueldoEmpleado = $_POST['sueldoEmpleado'];
                $alta = "INSERT INTO empleado (NombreEmpleado, EdadEmpleado, DireccionEmpleado, TelefonoEmpleado, SueldoEmpleado) VALUES ('$NombreEmpleado', '$EdadEmpleado', '$DireccionEmpleado', '$TelefonoEmpleado', '$SueldoEmpleado')";
                
                $conexion->query($alta);
                if ($conexion->affected_rows == 1){ //revisamos que se insertó registro
                    echo "exito";
                }
                else {
                    echo "error";
                }
                break;
                
            case "cliente":
                
                $nombreCliente = $_POST['nombreCliente'];
                $edadCliente = $_POST['edadCliente'];
                $telefonoCliente = $_POST['telefonoCliente'];
                $direccionCliente = $_POST['direccionCliente'];
                $alta= "INSERT INTO cliente (NombreCliente, EdadCliente, TelefonoCliente, DireccionCliente) VALUES ('$nombreCliente', '$edadCliente', '$telefonoCliente', '$direccionCliente')";
                $empleado = $_POST['idEmpleado']; //id del empleado
                $productos = $_POST['productos']; // productos comprados
                $idProductos = getArray($productos); // meter productos a array

                $conexion->query($alta); // alta al nuevo cliente
                
                // Recuperar el Id del cliente nuevo 
                $sql = "SELECT IdCliente FROM cliente WHERE NombreCliente LIKE BINARY '$nombreCliente'";
                $res = $conexion->query($sql);
                $fila = $res->fetch_assoc();
                $id = $fila['IdCliente'];
                
                // Insertar en la tabla de Comprar y de Vender
                foreach($idProductos as $idProd){
                    $sql = "INSERT INTO comprar VALUES (".$id.",".$idProd.")";
                    $conexion->query($sql);
                    
                    $sql = "INSERT INTO vender VALUES (".$empleado.",".$idProd.")";
                    $conexion->query($sql);
                }
                
                // Insertar en la tabla de Atender
                $sql = "INSERT INTO atender VALUES (".$id.",".$empleado.")";
                $conexion->query($sql);
                
                if ($conexion->affected_rows >= 1){ //revisamos que se insertó registro
                    echo "exito";
                }
                else {
                    echo "error";
                }
                break;
                
            case "proveedor":
                
                $nomProveedor = $_POST['nombreProveedor'];
                $edadProveedor = $_POST['edadProveedor'];
                $telProveedor = $_POST['telefonoProveedor'];
                $direccion = $_POST['direccionProveedor'];
                $alta = "INSERT INTO proveedor (NombreProveedor, EdadProveedor, TelefonoProveedor, DireccionProveedor) VALUES ('$nomProveedor', '$edadProveedor', '$telProveedor', '$direccion')";
                
                $conexion->query($alta);
                if ($conexion->affected_rows == 1){ //revisamos que se insertó registro
                    echo "exito";
                }
                else {
                    echo "error";
                }
                break;
        }
    }  

    function getArray($cadena){
        $arreglo = array();
        
        while(true){
            
            if(strpos($cadena,",")){
                $j = strpos($cadena,",")+1;
                $aux = substr($cadena,0,$j-1);
                array_push($arreglo,$aux);
                $cadena = substr($cadena,$j,strlen($cadena)-1);
            }else{
                array_push($arreglo,$cadena);
                break;
            }
        }
        return $arreglo;
    }
?>