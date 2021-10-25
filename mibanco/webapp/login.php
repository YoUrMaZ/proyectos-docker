<?php
// Initialize the session
session_start();
$valor = date('day');
setcookie("fecha", $valor);

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "configuracion.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor introduce un email";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduce una contraseña";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM usuarios WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $result = $stmt->get_result();

                // Check if username exists, if yes then verify password
                if ($result->num_rows == 1) {
                    // Bind result variables
                    $fila = $result->fetch_assoc();
                    if (password_verify($password, $fila["password"])) {
                        // Password is correct, so start a new session

                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $fila["id"];
                        $_SESSION["email"] = $fila["email"];

                        // Redirect user to welcome page
                        header("location: welcome.php");
                    } else {
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid username or password.";
                    }

                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style
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
                        <p class="lead">Bienvenido al centro de salud</p>
                    </div>
                        <?php
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'es invalida' : ''; ?>" value="<?php echo $email; ?>" >
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'es invalida' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <br/>
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger col-6" value="inicia sesion">
                            </div>
                            <p>¿No tienes cuenta? <a href="registro.php">Registrese ahora</a>.</p>
                        </form>
                    </div>
                    <br/><br/><br/><br/><br/>
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
