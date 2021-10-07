<?php
// Initialize the session
session_start();
 
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter username.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, passwd FROM usuarios WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $result = $stmt->get_result();
                
                // Check if username exists, if yes then verify password
                if($result->num_rows == 1){
                    // Bind result variables
                    $fila = $result->fetch_assoc();

                        if(password_verify($password, $fila["passwd"])){
                            // Password is correct, so start a new session

                            if(!isset($_SESSION))
                            {
                                session_start();
                            }

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $fila["id"];
                            $_SESSION["username"] = $fila["email"];
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();

?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form>
        <img class="mb-4" src="imagenes/pelotaLogo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">¡Bienvenido</h1>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <label for="floatingInput">Correo electronico</label>
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <label for="floatingPassword">Contraseña</label>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordar más tarde
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar sesion</button>
            <p>¿No tienes cuenta aún?<a href="registro.php">Registrate ahora</a>.</p>
            <p class="mt-5 mb-3 text-muted">&copy;2001–2021</p>
        </form>
    </form>
    </main>
</body>
</html>