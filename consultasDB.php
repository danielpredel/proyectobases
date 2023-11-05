<?php
    $servidor = 'localhost';
    $cuenta = 'root';
    $password = '';
    $base = 'farmacia';
    // Conexion con la base de datos 
    $conexion = new mysqli($servidor,$cuenta,$password,$base);
    $operacion = $_POST['operacion'];
    switch($operacion) {
        case "algebra":
            $algebra = array();
            array_push($algebra,"SELECT NombreEmpleado, DireccionEmpleado FROM empleado WHERE SueldoEmpleado >= 10000 AND SueldoEmpleado <= 20000");
            array_push($algebra,"SELECT * FROM cliente WHERE EdadCliente = 18 OR EdadCliente = 25");
            array_push($algebra,"SELECT * FROM proveedor WHERE DireccionProveedor LIKE '%Zacatecas%'");
            array_push($algebra,"SELECT IdProducto, NombreProducto, Marca FROM producto WHERE Costo > 200");
            array_push($algebra,"SELECT AVG(EdadCliente) AS PromedioEdad FROM cliente WHERE DireccionCliente LIKE '%Aguascalientes%'");
            array_push($algebra,"SELECT * FROM empleado WHERE SueldoEmpleado >= 5000 AND EdadEmpleado > 25;");
            array_push($algebra,"SELECT * FROM producto WHERE Marca='Bayer';");
            array_push($algebra,"SELECT IdProducto, NombreProducto FROM producto WHERE Existencia = 0;");
            array_push($algebra,"SELECT MIN(EdadEmpleado) AS EdadMin FROM empleado;");
            array_push($algebra,"SELECT NombreProveedor, EdadProveedor, DireccionProveedor FROM proveedor WHERE DireccionProveedor LIKE '%Aguascalientes%' OR DireccionProveedor LIKE '%Guadalajara%';");
            $consulta = $algebra[$_POST['id']];
            break;
        case "calculo":
            $calculo = array();
            array_push($calculo,"SELECT * FROM empleado WHERE SueldoEmpleado > 6000");
            array_push($calculo,"SELECT NombreProducto FROM producto WHERE Costo < 50");
            array_push($calculo,"SELECT TelefonoProveedor, NombreProveedor FROM proveedor WHERE DireccionProveedor LIKE '%San Pancho%' and EdadProveedor=40");
            array_push($calculo,"SELECT a.IdProducto,a.NombreProducto,a.Marca,a.Costo,a.Existencia FROM producto as a, suministrar as b, proveedor as c WHERE c.DireccionProveedor LIKE '%San Pancho%' and c.IdProveedor=b.ProveedorIdProveedor AND b.ProductoIdProducto=a.IdProducto");
            array_push($calculo,"SELECT a.IdCliente FROM cliente as a, comprar as b, producto as c WHERE c.Costo < 30 and c.IdProducto=b.ProductoIdProducto GROUP BY IdCliente");
            array_push($calculo,"SELECT * FROM comprar");
            array_push($calculo,"SELECT a.NombreProducto, b.ProveedorIdProveedor FROM producto as a, suministrar as b WHERE a.Costo > 3000 and a.IdProducto=b.ProductoIdProducto");
            array_push($calculo,"SELECT a.EmpleadoIdEmpleado, a.ProductoIdProducto FROM vender as a, producto as b WHERE b.Costo > 450 and b.IdProducto=a.ProductoIdProducto");
            array_push($calculo,"SELECT a.ClienteIdCliente FROM comprar as a, producto as b WHERE b.Costo > 700 and b.Marca LIKE '%Pfizer%' and b.IdProducto=a.ProductoIdProducto");
            //Corregir
            array_push($calculo,"SELECT a.ProveedorIdProveedor FROM suministrar as a, producto as b WHERE b.Marca LIKE '%Acofarma%' and b.IdProducto=a.ProductoIdProducto GROUP BY ProveedorIdProveedor");
            $consulta = $calculo[$_POST['id']];
            break;
        case "sql":
            $consulta = $_POST['consulta'];
            break;
    }
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    }
    else {
        $datos = $conexion->query($consulta);
        $atributos = array();
        if ($datos->num_rows) {
            echo '<table class="table">
                <thead>
                    <tr>';
            while ($finfo = $datos->fetch_field()) {
                array_push($atributos,$finfo->name);
                echo '<th scope="col">' .$finfo->name .'</th>';
            }
            echo '</tr>
                </thead>
                <tbody>';
            while ($fila = $datos->fetch_assoc()) {
                echo '<tr>';
                for($i=0; $i < count($atributos); $i++) {
                    echo '<td>' .$fila[$atributos[$i]] .'</td>';
                }
                echo '</tr>';
            }
        echo '</tbody>
            </table>';
        }
    }
?>