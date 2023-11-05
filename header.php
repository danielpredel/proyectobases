<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmacia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Farmacia</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="altas" onclick="menu(this.id)">Altas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="bajas" onclick="menu(this.id)">Bajas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="cambios" onclick="menu(this.id)">Cambios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="consultas" onclick="menu(this.id)">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="sql" onclick="menu(this.id)">SQL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="algebra" onclick="menu(this.id)">Álgebra Relacional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="calculo" onclick="menu(this.id)">Cálculo Relacional</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>