
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            font-family: Arail, sans-serif;
        }
        /* Formatting search box */
        .search-box{
            width: 600px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }
        .search-box input[type="text"]{
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }
        .result{
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }
        .search-box input[type="text"], .result{
            width: 100%;
            box-sizing: border-box;
        }
        /* Formatting result items */
        .result p{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>
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
    <script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
        <img src="imagenes/logo_principal.jpg" height="60" width="120">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
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
                <li class="nav-item dropdown">
                    <a class="text-black nav-link" href="" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
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
    <br><br><br><br>
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

                        <br/>
                        <input type="submit" class="btn btn-danger" value="Enviar">
                        <a href="listado.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <br/><br/><br/><br/><br/><br/><br/><br/>

</main>

</body>
</html>

