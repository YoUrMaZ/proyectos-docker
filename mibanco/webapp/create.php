<?php
// Include config file
require_once "configuracion.php";
 
// Define variables and initialize with empty values
$nombre = $nombrelargo = $fabricante = $numdosis = "";
$tiempominimo =  $tiempomaximo = "";
$nombre_err = $nombrelargo_err = $fabricante_err = $numdosis_err ="";
$tiempominimo_err =  $tiempomaximo_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Please enter a name.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Please enter a valid name.";
    } else{
        $nombre = $input_nombre;
    }

    // Validate nombre_largo
    $input_nombrelargo = trim($_POST["nombrelargo"]);
    if(empty($input_nombre)){
        $nombrelargo_err = "Please enter a name.";
    } elseif(!filter_var($input_nombrelargo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombrelargo_err = "Please enter a valid name.";
    } else{
        $nombrelargo = $input_nombrelargo;
    }

    // Validate fabricante
    $input_fabricante = trim($_POST["fabricante"]);
    if(empty($input_fabricante)){
        $fabricante_err = "Please enter an address.";
    } else{
        $fabricante = $input_fabricante;
    }

    // Validate numdosis
    $input_numdosis = trim($_POST["numdosis"]);
    if(empty($input_numdosis)){
        $numdosis_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_numdosis)){
        $numdosis_err = "Please enter a positive integer value.";
    } else{
        $numdosis = $input_numdosis;
    }
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($fabricante_err) && empty($nombrelargo_err)&& empty($numdosis_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO vacuna (nombre, nombre_largo, fabricante, num_dosis) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssi", $param_nombre, $param_nombrelargo, $param_fabricante,
                $param_numdosis);

            // Set parameters
            $param_nombre = $nombre;
            $param_nombrelargo = $nombrelargo;
            $param_fabricante = $fabricante;
            $param_numdosis = $numdosis;


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: listado.php");
                exit();
            } else {
                echo "Oops! Algo fue mal. Please try again later.";
            }
            $stmt->close();
        }
        $mysqli->close();
    }
        // Close connection


}

?>
 
 <!DOCTYPE html>
<br lang="es">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
    <script src="js/script-footer.js" crossorigin="anonymous"></script>
    <link href="css/estilo-footer.css" rel="stylesheet">
</head>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
        <a href="welcome.php">
            <img src="imagenes/logo_principal.jpg"  height="60" width="120" >
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-black"></span>s
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
<main>

    <div class="wrapper">
        <br/><br/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear Vacuna</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Nombre largo</label>
                            <input type="text" name="nombrelargo" class="form-control <?php echo (!empty($nombrelargo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombrelargo; ?>">
                            <span class="invalid-feedback"><?php echo $nombrelargo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Fabricante</label>
                            <textarea name="fabricante" class="form-control <?php echo (!empty($fabricante_err)) ? 'is-invalid' : ''; ?>"><?php echo $fabricante; ?></textarea>
                            <span class="invalid-feedback"><?php echo $fabricante_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Número de dosis</label>
                            <input type="text" name="numdosis" class="form-control <?php echo (!empty($numdosis_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $numdosis; ?>">
                            <span class="invalid-feedback"><?php echo $numdosis_err;?></span>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-danger" value="enviar">
                        <a href="listado.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<br/><br/><br/><br/></br><br/>
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
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Redes sociales</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/saludcmadrid/?hl=es"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="https://twitter.com/SaludMadrid?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fab fa-fw fa-linkedin-in"></i></a>
            </div>
            <!-- Footer About Text-->
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