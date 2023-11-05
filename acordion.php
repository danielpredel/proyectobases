<?php
    $operacion = $_POST['operacion'];
    $algebra = array();
    array_push($algebra, "Realizar un reporte que muestre el nombre y dirección de los empleados con un sueldo entre $10,000 y $20,000");
    array_push($algebra, "Realizar un reporte que muestre todos los datos de los clientes con una edad de 18 años o 25 años");
    array_push($algebra, "Realizar un reporte que muestre todos los datos de los Proveedores de Zacatecas");
    array_push($algebra, "Realizar un reporte que muestre id, nombre y marca de los productos con costo mayor a $200");
    array_push($algebra, "Obtener el promedio de la edad de los clientes de Aguascalientes");
    array_push($algebra, "Realizar un reporte que muestre todos los datos de los empleados con sueldo mayor o igual a 5,000 y edad mayor a 25 años ");
    array_push($algebra, "Realizar un reporte que muestre todos los datos de los productos marca Bayer");
    array_push($algebra, "Realizar un reporte que muestre id y nombre del producto con existencias iguales a 0");
    array_push($algebra, "Realizar un reporte que muestre la edad del empleado más joven como EdadMin");
    array_push($algebra, "Realizar un reporte que muestre el nombre, la edad y el domicilio de los proveedores que son de Aguascalientes o de Guadalajara");

    $calculo = array();
    array_push($calculo, "Enlistar los datos de los empleados que tenga sueldo mayor a $6000");
    array_push($calculo, "Enlistar los nombres de los productos con un costo menor a $50");
    array_push($calculo, "Realizar un reporte que muestre teléfono y nombre de los proveedores que vivan en San Pancho y tengan una edad de 40 años");
    array_push($calculo, "Realizar un reporte que muestre los datos de los productos que ha dejado los proveedores que viven en San Pancho");
    array_push($calculo, "Realizar un reporte que muestre el id de cada cliente que ha comprado un producto con un costo de menor a $30");
    array_push($calculo, "Realizar un reporte que muestre el id del cliente y el id del producto de todos los clientes que han comprado productos en la farmacia");
    array_push($calculo, "Enlistar nombre del producto y el id del proveedor donde suministre productos con un costo mayor a $3000");
    array_push($calculo, "Realizar un reporte que muestre el id del Empleado y el id del Producto de todos los empleados que han vendido productos con un costo mayor a $450");
    array_push($calculo, "Realizar un reporte que muestre el id del Cliente donde ha comprado productos mayores a $700 y de la marca PFIZER");
    array_push($calculo, "Realizar un reporte que muestre el id del Proveedor que suministra productos de la marca ACOFARMA");

    if($operacion == "algebra") {
        $consultas = $algebra;
    }
    else if($operacion == "calculo"){
        $consultas = $calculo;
    }
    for($i = 0; $i < 10; $i++) {
        echo '<div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading' .$i .'">
                <button id="' .$i .'" onclick="consulta(this.id)" class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapse' .$i .'" aria-expanded="false" aria-controls="flush-collapse' .$i .'">';
        echo $consultas[$i];
        echo '</button>
            </h2>
            <div id="flush-collapse' .$i .'" class="accordion-collapse collapse" aria-labelledby="flush-heading' .$i .'"
                data-bs-parent="#relacional">
                <div class="accordion-body" id="resultado' .$i .'">
                </div>
            </div>
        </div>';
    }
?>