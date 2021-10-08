<?php
// Include config file
require_once "configuracion.php";

// Define variables and initialize with empty values
$email = $password = $confirm_password = $nombre = $direccion = $nickname  = "";
$email_err = $password_err = $confirm_password_err = $nombre_err = $apellidos_err = $nickname_err = $direccion_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a username.";
    } elseif(!preg_match('/^\S+@\S+\.\S+$/', trim($_POST["email"]))){
        $email_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                    $email_err = "This username is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (email, passwd, nombre) VALUES (?, ?, ?)";  // ÇINSERT INTO tabla (id, nombre, apellido)

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_email, $param_password, $param_nombre);

            // Set parameters
            $param_email = $email;
            $param_nombre = $nombre;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
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
    <title>Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <link href="css/form-validation.css" rel="stylesheet">
</head>
<body  class="bg-light">

<div class="container">
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="imagenes/pelotaLogo.png" alt="" width="72" height="72">
            <h2>Yourmaz</h2>
            <p class="lead">Para ser YoUrMaZeRs! es necesario que introuzcas tus datos personales</p>
        </div>
    </main>
    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
    <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Datos personales</h4>
        <form class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Es necesario Introducir un nombre
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="lastName" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Es necesario Introducir un apellido
                    </div>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Nickname</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="username" placeholder="Nickname" required>
                        <div class="invalid-feedback">
                            Es necesario Introducir un nickname
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="address" placeholder="Arroyo de la media legua 56 3D" required>
                    <div class="invalid-feedback">
                        Por favor introduce tu dirección
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="country" class="form-label">Pais</label>
                    <select class="form-select" id="country" required>
                        <option value="">Escoge...</option>
                        <option>Estados Unidos</option>
                        <option>España</option>
                        <option>Portugal</option>
                        <option>Francia</option>
                        <option>Italia</option>
                        <option>Reino Unido</option>
                        <option>Holanda</option>
                        <option>Finlandia</option>
                        <option>Suecia</option>
                        <option>Eslovaquia</option>
                        <option>Eslovenia</option>

                    </select>
                    <div class="invalid-feedback">
                        Please select a valid country.
                    </div>
                </div>


        <div class="col-12">
            <label>Direccion de Email</label>
            <label for="email" class="form-label"><span class="text-muted">(Opcional)</span></label>
            <input type="email" class="form-control" id="email" placeholder="hola@example.com" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirma Contraseña</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <hr class="my-4">
        <div class="form-group">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Continuar</button>
        </div>
        <p>¿Tienes una cuenta? <a href="login.php">login</a>.</p>
    </form>
</div>
</body>
</html>
