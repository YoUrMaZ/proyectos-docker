<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "configuracion.php";

    // Prepare a select statement
    $sql = "SELECT * FROM vacuna WHERE id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve individual field value
                $nombre = $row["nombre"];
                $fabricante = $row["fabricante"];
                $numdosis = $row["num_dosis"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Algo fue mal. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Vacuna</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrapper{
            margin: 600px;
            margin-bottom: 100px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
        <a href="welcome.php">
            <img src="imagenes/logo_principal.jpg"  height="60" width="120" >
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>s
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="text-black nav-link" href="create.php">Crear Vacuna</a>
                </li>
                <li class="nav-item active">
                    <a class="text-black nav-link" href="listado.php">lista de vacunas</a>
                </li>
                <li class="nav-item active">
                    <a class="text-black nav-link" href="pacientes.php">Registrar pacientes</a>
                </li>
                <li class="nav-item active">
                    <a class="text-black nav-link" href="listadoPacientes.php">Listado de Pacientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="text-black nav-link" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                        <a class="dropdown-item" href="perfil.php">Perfil</a>
                        <a class="dropdown-item" href="logout.php">cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper">
    <br/><br/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Ver Vacuna</h1>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b><?php echo $row["nombre"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Fabricante</label>
                    <p><b><?php echo $row["fabricante"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Núm. dosis</label>
                    <p><b><?php echo $row["num_dosis"]; ?></b></p>
                </div>
                <p><a href="listado.php" class="btn btn-dark">Volver</a></p>
            </div>
        </div>
    </div>
</div>
<footer class="footer text-center col-12">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Localizacion</h4>
                <p class="lead mb-0">
                    Av. Manuel Fraga Iribarne, 2
                    <br />
                    28055 Madrid
                </p>
            </div>

            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">Atencion al ciudadano</h4>
                <p class="lead mb-0">
                    Contacta con nosotros
                    <a href="https://www.comunidad.madrid/solicitud-informacion">contacta</a>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>