<?php
require_once "configuracion.php";
$nombre = $apellidos = $DNI = $edad = $vacuna = "";
$nombre_err = $apellidos_err = $DNI_err = $edad_err = $vacuna_err = "";


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

    // Validate apellidos
    $input_apellidos = trim($_POST["apellidos"]);
    if(empty($input_apellidos)){
        $apellidos_err = "Por favor introduce un apellido";
    } elseif(!filter_var($input_apellidos, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $apellidos_err = "Por favor introduce un apellido valido";
    } else{
        $apellidos = $input_apellidos;
    }
    //validate DNI
    $input_DNI = trim($_POST["DNI"]);
    if(empty($input_DNI)){
        $DNI_err = "Por favor, Introduce un DNI";
    } elseif(!filter_var($input_DNI, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{8,8}[A-Za-z]$/")))){
        $DNI_err = "Por favor, Introduce un DNI valido";
    } else{
        $DNI = $input_DNI;
    }

    // Validate Edad
    $input_edad = trim($_POST["edad"]);
    if(empty($input_edad)){
        $edad_err = "Por favor introduce una edad";
    } elseif(!ctype_digit($input_edad)){
        $edad_err = "Por favor introduce un valor positivo";
    } else{
        $edad = $input_edad;
    }

    // Validate Vacuna
    $input_vacuna = trim($_POST["vacuna"]);
    if(empty($input_vacuna)){
        $vacuna_err = "Por favor introduce una vacuna";
    } elseif(!filter_var($input_vacuna, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $vacuna_err = "Por favor introduce una vacuna valida";
    } else{
        $vacuna = $input_vacuna;
    }


    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($DNI_err) && empty($vacuna_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pacientes (nombre, apellidos, DNI, edad, vacuna) VALUES (?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssis", $param_nombre, $param_apellidos, $param_DNI,
                $param_edad, $param_vacuna);

            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_DNI = $DNI;
            $param_edad = $edad;
            $param_vacuna = $vacuna;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: listadoPacientes.php");
                exit();
            } else{
                echo "Oops! Algo fue mal. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        .wrapper{
            margin: 600px;
            margin-bottom: 100px;
            margin-top: 100px;


        }
    .result p {
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover {
        background: #f2f2f2;
    }

    </style>
    <script src="js/script-footer.js" crossorigin="anonymous"></script>
    <link href="css/estilo-footer.css" rel="stylesheet">



    <meta charset="UTF-8">
    <title>PHP MySQL AJAX ejemplo</title>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("buscar-backend.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
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
<main role="main">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-5">Registro paciente</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control <?php echo (!empty($apellidos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellidos; ?>">
                            <span class="invalid-feedback"><?php echo $apellidos_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>DNI</label>
                            <input type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DNI; ?>">
                            <span class="invalid-feedback"><?php echo $DNI_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Edad</label>
                            <input type="text" name="edad" class="form-control <?php echo (!empty($edad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $edad; ?>">
                            <span class="invalid-feedback"><?php echo $edad_err;?></span>
                        </div>
                        <div class="search-box">
                            <label>Vacuna</label>
                            <input type="text" name="vacuna" class="form-control <?php echo (!empty($vacuna_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $vacuna; ?>">
                            <span class="invalid-feedback"><?php echo $vacuna_err;?></span>
                            <div class="result"></div>
                        </div>
                        <br/><br/>
                        <input type="submit" class="btn btn-danger" value="Enviar">
                        <a href="listado.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
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
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Redes sociales</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/saludcmadrid/?hl=es"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://twitter.com/SaludMadrid?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fab fa-fw fa-twitter-in"></i></a>
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
</main>

</body>
</html>


