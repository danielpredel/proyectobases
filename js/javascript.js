window.addEventListener("load", function () {
    operacion = document.getElementById('operacion').value;
    if (operacion == "algebra" || operacion == "calculo" || operacion == "sql") {
        menuRelacional();
    } else {
        if (operacion == "consultas") {
            extra = '<option value="producto" selected>Producto</option>';
            extra += '<option value="empleado">Empleado</option>';
            extra += '<option value="cliente">Cliente</option>';
            extra += '<option value="proveedor">Proveedor</option>';
            extra += '<option value="vender">Vender</option>';
            extra += '<option value="comprar">Comprar</option>';
            extra += '<option value="atender">Atender</option>';
            extra += '<option value="suministrar">Suministrar</option>';
            document.getElementById('menuTabla').innerHTML = extra;
        }
        menuTabla();
    }
});

function menu(id) { //Menu del header
    switch (id) {
        case "altas":
            window.location.href = "index.php";
            break;
        case "bajas":
            window.location.href = "bajas.php";
            break;
        case "cambios":
            window.location.href = "cambios.php";
            break;
        case "consultas":
            window.location.href = "consultas.php";
            break;
        case "sql":
            window.location.href = "sql.php";
            break;
        case "algebra":
            window.location.href = "algebra.php";
            break;
        case "calculo":
            window.location.href = "calculo.php";
            break;
    }
}

function menuTabla() { //Menu de tabla
    operacion = document.getElementById('operacion').value;
    tabla = document.getElementById('menuTabla').value;
    var envio = new XMLHttpRequest();
    if (operacion == "altas" || operacion == "edicion") {
        cadena = "idTabla=" + tabla;
        envio.open('POST', 'formulario.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            document.getElementById('formulario').innerHTML = resp;
            if (operacion == "edicion") {
                document.getElementById('btn').innerHTML = '<button class="btn btn-primary" onclick="cambios()">Editar</button>';
                if(tabla == "cliente" || tabla == "producto") {
                    document.getElementById('datosExtra').innerHTML = '';
                }
                console.log("Antes llenar");
                llenarCampos();
            }
        }
        envio.send(cadena);
    } else {
        cadena = "operacion=" + operacion + "&tabla=" + tabla;
        envio.open('POST', 'tablasDinamicas.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            document.getElementById('tabla').innerHTML = resp;
        }
        envio.send(cadena);
    }
}

function menuRelacional() {
    operacion = document.getElementById('operacion').value;
    var envio = new XMLHttpRequest();
    cadena = "operacion=" + operacion;
    if (operacion == "sql") {

    } else {
        envio.open('POST', 'acordion.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            document.getElementById('relacional').innerHTML = resp;
        }
        envio.send(cadena);
    }
}

function altas() {
    tabla = document.getElementById('menuTabla').value;
    var envio = new XMLHttpRequest();
    cadena = "tabla=" + tabla;
    var completo = false;

    switch (tabla) {

        case "producto":
            nombre = document.getElementById('nombreProducto').value;
            marca = document.getElementById('marcaProducto').value;
            costo = document.getElementById('costoProducto').value;
            existencia = document.getElementById('existenciaProducto').value;

            check = document.querySelectorAll('input[name="proveedor"]:checked');
            values = [];
            check.forEach((checkbox) => {
                values.push(checkbox.value);
            });

            proveedores = "";
            for (i = 0; i < values.length; i++) {
                if (i + 1 != values.length) {
                    proveedores += values[i] + ",";
                } else {
                    proveedores += values[i];
                }
            }

            if (nombre != '' && marca != '' && costo != '' && existencia != '') {
                completo = true;
                cadena += "&nombreProducto=" + nombre + "&marcaProducto=" + marca + "&costoProducto=" + costo + "&existenciaProducto=" + existencia + "&proveedores=" + proveedores;
            }
            if(values.length == 0) {
                completo = false;
            }
            break;

        case "empleado":
            nombre = document.getElementById('nombreEmpleado').value;
            edad = document.getElementById('edadEmpleado').value;
            direccion = document.getElementById('direccionEmpleado').value;
            telefono = document.getElementById('telefonoEmpleado').value;
            sueldo = document.getElementById('sueldoEmpleado').value;
            if (nombre != '' && edad != '' && direccion != '' && telefono != '' && sueldo != '') {
                completo = true;
                cadena += "&nombreEmpleado=" + nombre + "&edadEmpleado=" + edad + "&direccionEmpleado=" + direccion + "&telefonoEmpleado=" + telefono + "&sueldoEmpleado=" + sueldo;
            }
            break;

        case "cliente":

            nombre = document.getElementById('nombreCliente').value;
            edad = document.getElementById('edadCliente').value;
            direccion = document.getElementById('direccionCliente').value;
            telefono = document.getElementById('telefonoCliente').value;
            empleados = document.getElementsByName('empleado');
            empleado = '';
            for(i = 0; i < empleados.length; i++) {
                if(empleados[i].checked) {
                    empleado = empleados[i].value;
                    break;
                }
            }

            check = document.querySelectorAll('input[name="productos"]:checked');
            values = [];
            check.forEach((checkbox) => {
                values.push(checkbox.value);
            });

            productos = "";
            for (i = 0; i < values.length; i++) {
                if (i + 1 != values.length) {
                    productos += values[i] + ",";
                } else {
                    productos += values[i];
                }
            }
            console.log(empleado);
            console.log(productos);
            if (nombre != '' && edad != '' && direccion != '' && telefono != '' && empleado != '') {

                completo = true;
                cadena += "&nombreCliente=" + nombre + "&edadCliente=" + edad + "&direccionCliente=" + direccion + "&telefonoCliente=" + telefono + "&idEmpleado=" + empleado + "&productos=" + productos;
            }
            if(values.length == 0 || empleado == '') {
                completo = false;
            }
            break;

        case "proveedor":

            nombre = document.getElementById('nombreProveedor').value;
            edad = document.getElementById('edadProveedor').value;
            direccion = document.getElementById('direccionProveedor').value;
            telefono = document.getElementById('telefonoProveedor').value;
            if (nombre != '' && edad != '' && direccion != '' && telefono != '') {
                completo = true;
                cadena += "&nombreProveedor=" + nombre + "&edadProveedor=" + edad + "&direccionProveedor=" + direccion + "&telefonoProveedor=" + telefono;
            }
            break;
    }

    if (completo) {
        envio.open('POST', 'altasDB.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            if (resp == "exito") {
                swal({
                    title: "Registro Insertado Correctamente",
                    icon: "success",
                });
                menuTabla();
            } else {
                swal({
                    title: "Error al Insertar el Registro",
                    icon: "error",
                });
            }
        }
        envio.send(cadena);
    } else {
        swal({
            title: "Datos Incompletos",
            icon: "error",
        });
    }
}

function bajas(id) {
    swal({
            title: "¿Deseas borrar este registro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                tabla = document.getElementById('menuTabla').value;
                var envio = new XMLHttpRequest();
                cadena = "tabla=" + tabla + "&id=" + id;
                envio.open('POST', 'bajasDB.php', true);
                envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                envio.onload = function () {
                    var resp = envio.responseText;
                    if (resp == "exito") {
                        swal("Registro Eliminado Exitosamente", {
                            icon: "success",
                        });
                        menuTabla();
                    } else {
                        swal("Error al Eliminar el Registro", {
                            icon: "error",
                        });
                    }
                }
                envio.send(cadena);
            }
        });
}

function llenarCampos() {
    console.log("Llenar Campos");
    tabla = document.getElementById('menuTabla').value;
    id = document.getElementById('id').value;
    var envio = new XMLHttpRequest();
    cadena = "tabla=" + tabla + "&id=" + id;
    envio.open('POST', 'datos.php', true);
    envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    envio.onload = function () {
        var resp = JSON.parse(envio.responseText);
        switch (tabla) {
            case "producto":
                document.getElementById('nombreProducto').value = resp[1];
                document.getElementById('marcaProducto').value = resp[2];
                document.getElementById('costoProducto').value = resp[3];
                document.getElementById('existenciaProducto').value = resp[4];
                break;
            case "empleado":
                document.getElementById('nombreEmpleado').value = resp[1];
                document.getElementById('edadEmpleado').value = resp[2];
                document.getElementById('direccionEmpleado').value = resp[3];
                document.getElementById('telefonoEmpleado').value = resp[4];
                document.getElementById('sueldoEmpleado').value = resp[5];
                break;
            case "cliente":
                document.getElementById('nombreCliente').value = resp[1];
                document.getElementById('edadCliente').value = resp[2];
                document.getElementById('telefonoCliente').value = resp[3];
                document.getElementById('direccionCliente').value = resp[4];
                break;
            case "proveedor":
                nombre = document.getElementById('nombreProveedor').value = resp[1];
                edad = document.getElementById('edadProveedor').value = resp[2];
                telefono = document.getElementById('telefonoProveedor').value = resp[3];
                direccion = document.getElementById('direccionProveedor').value = resp[4];
                break;
        }
    }
    envio.send(cadena);
}

function cambios() {
    tabla = document.getElementById('menuTabla').value;
    id = document.getElementById('id').value;
    cadena = "tabla=" + tabla + '&id=' + id;
    var completo = false;
    var envio = new XMLHttpRequest();
    switch (tabla) {
        case "producto":
            nombre = document.getElementById('nombreProducto').value;
            marca = document.getElementById('marcaProducto').value;
            costo = document.getElementById('costoProducto').value;
            existencia = document.getElementById('existenciaProducto').value;
            if (nombre != '' && marca != '' && costo != '' && existencia != '') {
                completo = true;
                cadena += "&nombreProducto=" + nombre + "&marcaProducto=" + marca + "&costoProducto=" + costo + "&existenciaProducto=" + existencia;
            }
            break;
        case "empleado":
            nombre = document.getElementById('nombreEmpleado').value;
            edad = document.getElementById('edadEmpleado').value;
            direccion = document.getElementById('direccionEmpleado').value;
            telefono = document.getElementById('telefonoEmpleado').value;
            sueldo = document.getElementById('sueldoEmpleado').value;
            if (nombre != '' && edad != '' && direccion != '' && telefono != '' && sueldo != '') {
                completo = true;
                cadena += "&nombreEmpleado=" + nombre + "&edadEmpleado=" + edad + "&direccionEmpleado=" + direccion + "&telefonoEmpleado=" + telefono + "&sueldoEmpleado=" + sueldo;
            }
            break;
        case "cliente":
            nombre = document.getElementById('nombreCliente').value;
            edad = document.getElementById('edadCliente').value;
            direccion = document.getElementById('direccionCliente').value;
            telefono = document.getElementById('telefonoCliente').value;
            if (nombre != '' && edad != '' && direccion != '' && telefono != '') {
                completo = true;
                cadena += "&nombreCliente=" + nombre + "&edadCliente=" + edad + "&direccionCliente=" + direccion + "&telefonoCliente=" + telefono;
            }
            break;
        case "proveedor":
            nombre = document.getElementById('nombreProveedor').value;
            edad = document.getElementById('edadProveedor').value;
            direccion = document.getElementById('direccionProveedor').value;
            telefono = document.getElementById('telefonoProveedor').value;
            if (nombre != '' && edad != '' && direccion != '' && telefono != '') {
                completo = true;
                cadena += "&nombreProveedor=" + nombre + "&edadProveedor=" + edad + "&direccionProveedor=" + direccion + "&telefonoProveedor=" + telefono;
            }
            break;
    }
    if (completo) {
        envio.open('POST', 'cambiosDB.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            if (resp == "exito") {
                swal({
                    title: "Registro Editado Correctamente",
                    icon: "success",
                }).then(() => {
                    window.location.href = "cambios.php";
                });
            } else {
                swal({
                    title: "Error al Editar el Registro",
                    icon: "error",
                });
            }
        }
        envio.send(cadena);
    } else {
        swal({
            title: "Hay Campos Vacios",
            icon: "error",
        });
    }
}

function consulta(id) {
    operacion = document.getElementById('operacion').value;
    var envio = new XMLHttpRequest();
    if (operacion == "sql") {
        consultaInput = document.getElementById('consulta').value;
        cadena = "operacion=" + operacion + "&consulta=" + consultaInput;
        envio.open('POST', 'consultasDB.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            document.getElementById('resultado').innerHTML = resp;
        }
        envio.send(cadena);
    } else {
        cadena = "operacion=" + operacion + "&id=" + id;
        envio.open('POST', 'consultasDB.php', true);
        envio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        envio.onload = function () {
            var resp = envio.responseText;
            document.getElementById('resultado' + id).innerHTML = resp;
        }
        envio.send(cadena);
    }
}