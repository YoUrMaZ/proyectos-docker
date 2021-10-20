<?php
require_once "configuracion.php";
$nombre = $apellidos = $DNI = $edad = "";
$nombre_err = $apellidos = $DNI_err = $edad_err = "";


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
        $DNI_err = "Please enter a name.";
    } elseif(!filter_var($input_DNI, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{8,8}[A-Za-z]$/")))){
        $DNI_err = "Please enter a valid name.";
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
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($fabricante_err) && empty($nombrelargo_err)&& empty($numdosis_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pacientes (nombre, apellidos, DNI, edad) VALUES (?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssi", $param_nombre, $param_apellidos, $param_DNI,
                $param_edad);

            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_DNI = $DNI;
            $param_edad = $edad;



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
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="listado.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
?>
