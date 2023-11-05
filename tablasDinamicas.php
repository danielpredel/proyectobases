<?php
    $servidor = 'localhost';
    $cuenta = 'root';
    $password = '';
    $base = 'farmacia';
    // Conexion con la base de datos 
    $conexion = new mysqli($servidor,$cuenta,$password,$base);
    $operacion = $_POST['operacion'];
    $tabla = $_POST['tabla'];
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    }
    else {
        $sql = "DESC $tabla;";
        $estructura = $conexion->query($sql);
        $atributos = array();
        if ($estructura->num_rows) {
            echo '<table class="table">
                <thead>
                    <tr>';
            while ($fila = $estructura->fetch_assoc()) {
                array_push($atributos, $fila['Field']);
            }
            for($i=0; $i < count($atributos); $i++) {
                echo '<th scope="col">' .$atributos[$i] .'</th>';
            }
            if($operacion == "bajas") {
                echo '<th scope="col">Eliminar</th>';
            }
            else if($operacion == "cambios") {
                echo '<th scope="col">Editar</th>';
            }
            echo '</tr>
                </thead>
                <tbody>';
            $sql = "SELECT * FROM $tabla;";
            $datos = $conexion->query($sql);
            if ($datos->num_rows) {
                while ($fila = $datos->fetch_assoc()) {
                    $id=$fila[$atributos[0]];
                    echo '<tr>';
                    for($i=0; $i < count($atributos); $i++) {
                        echo '<td>' .$fila[$atributos[$i]] .'</td>';
                    }
                    if($operacion == "bajas") {
                        echo '<td><button type="button" class="btn btn-danger" id="' .$id .'" onclick="bajas(this.id)">Eliminar</button></td>';
                    }
                    else if($operacion == "cambios") {
                        echo '<td>
                            <form action="editar.php" method="post">
                                <input type="hidden" value="' .$id .'" name="id">
                                <input type="hidden" value="' .$tabla .'" name="tabla">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </td>';
                    }
                    echo '</tr>';
                }
            }
            echo '</tbody>
                </table>';
        }
    }
?>