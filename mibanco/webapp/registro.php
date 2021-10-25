<?php
require_once "configuracion.php";
$nombre = $apellidos = $direccion = $edad = $email = $password = $confirm_password ="";
$nombre_err = $apellidos_err = $direccion_err = $edad_err = $email_err = $password_err = $confirm_password_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor, introduce un nombre";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Por favor, Introduce un nombre valido";
    } else {
        $nombre = $input_nombre;
    }

    // Validar apellidos
    $input_apellidos = trim($_POST["apellidos"]);
    if (empty($input_apellidos)) {
        $apellidos_err = "Por favor introduce un apellido";
    } elseif (!filter_var($input_apellidos, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $apellidos_err = "Por favor introduce un apellido valido";
    } else {
        $apellidos = $input_apellidos;
    }
    //validar direccion
    $input_direccion = trim($_POST["direccion"]);
    if (empty($input_direccion)) {
        $direccion_err = "Por favor Introduce una direccion.";
    } elseif (!filter_var($input_direccion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[A-Za-z0-9]+/")))) {
        $direccion_err = "Por favor introduce una direccion valida";
    } else {
        $direccion = $input_direccion;
    }

    //validar fecha de nacimiento
    $input_edad = trim($_POST["edad"]);
    if (empty($input_edad)) {
        $edad_err = "Por favor, introduce una fecha.";
    } elseif (!filter_var($input_edad, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/")))) {
        $edad_err = "Por favor introduce una fecha de nacimiento valida";
    } else {
        $edad = $input_edad;
    }

    //validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, introduce un email";
    } elseif (!preg_match('/^\S+@\S+\.\S+$/', trim($_POST["email"]))) {
        $email_err = "el email solo puede contener letras, numeros y guiones bajos";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $email_err = "Este usuario ya ha sido registrado";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Algo fue mal. Intentalo mas tarde";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduce una contraseña";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe contener al menos 6 caracteres";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, introduce la confirmacion de la contraseña";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "La contraseña no coincidio";
        }
    }

    // Check input errors before inserting in database
    if (empty($nombre_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (nombre, apellidos, direccion, edad, email, password) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_nombre, $param_apellidos, $param_direccion,
                $param_edad, $param_email, $param_password);

            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_direccion = $direccion;
            $param_edad = $edad;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: login.php");
                exit();
            } else {
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
<body>
<main>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="py-5 text-center">
                        <img class="d-block mx-auto mb-4" src="imagenes/logo_principal.jpg" alt="" width="120" height="72">
                        <h2>Centro Virtual Sanitario</h2>
                        <p class="lead">Bienvenido al centro de salud, por favor registrese</p>
                    </div>
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
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="form-control <?php echo (!empty($direccion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $direccion; ?>" placeholder="Arroyo de la media Legua 154 2D">
                        <span class="invalid-feedback"><?php echo $direccion_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Fecha de nacimiento</label>
                        <input type="text" name="edad" class="form-control <?php echo (!empty($edad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $edad; ?>" placeholder="YYYY-MM-DD">
                        <span class="invalid-feedback"><?php echo $edad_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Correo electronico</label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="ejemplo@ejemplo.com">
                        <span class="invalid-feedback"><?php echo $email_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err;?></span>
                    </div>
                    <br/>
                    <input type="submit" class="btn btn-danger col-7 ml-2" value="Registrarse">
                    <a href="listado.php" class="btn btn- ml-2 col-4">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

        <p>¿Tienes una cuenta creada? <a href="login.php">inicia sesion</a>.</p>
        <br/>
</div>
</main>


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