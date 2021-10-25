<?php
session_start();
include 'configuracion.php';

$mysqli = new mysqli("db", "quevedo", "quevedo", "quevedodb");


$email = $_SESSION['email'];
if (!isset($email)){
    header("location:login.php");
}

$consulta = "SELECT * FROM usuarios where email = '$email'";
$ejecuta = $mysqli->query($consulta);
$extraer = $ejecuta->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apock web design</title>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/script-footer.js" crossorigin="anonymous"></script>
    <link href="css/estilo-footer.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
</head>
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

<body>
<style type="text/css">
    /*=====================================
    reset estilos
    no es necesario que copies esto
    =====================================*/

    html {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        text-size-adjust: 100%;
        line-height: 1.4;
    }


    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        color: #404040;
        font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
    }

    /*=====================================
    estilos de la utilidad
    Copiar esto
    =====================================*/
    .seccion-perfil-usuario .perfil-usuario-body,
    .seccion-perfil-usuario {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-items: center;
    }

    .seccion-perfil-usuario .perfil-usuario-header {
        width: 100%;
        display: flex;
        justify-content: center;
        background: linear-gradient(darkred, transparent);
        margin-bottom: 1.25rem;
    }

    .seccion-perfil-usuario .perfil-usuario-portada {
        display: block;
        position: relative;
        width: 90%;
        height: 17rem;
        background: linear-gradient(45deg, red, white);
        border-radius: 0 0 20px 20px;
    }

    .seccion-perfil-usuario .perfil-usuario-portada .boton-portada {
        position: absolute;
        top: 1rem;
        right: 1rem;
        border: 0;
        border-radius: 8px;
        padding: 12px 25px;
        background-color: rgba(0, 0, 0, .5);
        color: #fff;
        cursor: pointer;
    }

    .seccion-perfil-usuario .perfil-usuario-portada .boton-portada i {
        margin-right: 1rem;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar {
        display: flex;
        width: 180px;
        height: 180px;
        align-items: center;
        justify-content: center;
        border: 7px solid #FFFFFF;
        background-color: #DFE5F2;
        border-radius: 50%;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        position: absolute;
        bottom: -40px;
        left: calc(50% - 90px);
        z-index: 1;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar img {
        width: 100%;
        position: relative;
        border-radius: 50%;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar .boton-avatar {
        position: absolute;
        left: -2px;
        top: -2px;
        border: 0;
        background-color: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
    }

    .seccion-perfil-usuario .perfil-usuario-body {
        width: 70%;
        position: relative;
        max-width: 750px;
    }

    .seccion-perfil-usuario .perfil-usuario-body .titulo {
        display: block;
        width: 100%;
        font-size: 1.75em;
        margin-bottom: 0.5rem;
    }

    .seccion-perfil-usuario .perfil-usuario-body .texto {
        color: #848484;
        font-size: 0.95em;
    }

    .seccion-perfil-usuario .perfil-usuario-footer,
    .seccion-perfil-usuario .perfil-usuario-bio {
        display: flex;
        flex-wrap: wrap;
        padding: 1.5rem 2rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        background-color: #fff;
        border-radius: 15px;
        width: 100%;
    }

    .seccion-perfil-usuario .perfil-usuario-bio {
        margin-bottom: 1.25rem;
        text-align: center;
    }

    .seccion-perfil-usuario .lista-datos {
        width: 50%;
        list-style: none;
    }

    .seccion-perfil-usuario .lista-datos li {
        padding: 5px 0;
    }

    .seccion-perfil-usuario .lista-datos li>.icono {
        margin-right: 1rem;
        font-size: 1.2rem;
        vertical-align: middle;
    }

    .seccion-perfil-usuario .redes-sociales {
        position: absolute;
        right: calc(0px - 50px - 1rem);
        top: 0;
        display: flex;
        flex-direction: column;
    }

    .seccion-perfil-usuario .redes-sociales .boton-redes {
        border: 0;
        background-color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        color: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        font-size: 1.3rem;
    }

    .seccion-perfil-usuario .redes-sociales .boton-redes+.boton-redes {
        margin-top: .5rem;
    }

    .seccion-perfil-usuario .boton-redes.facebook {
        background-color: #5955FF;
    }

    .seccion-perfil-usuario .boton-redes.twitter {
        background-color: #35E1BF;
    }

    .seccion-perfil-usuario .boton-redes.instagram {
        background: linear-gradient(45deg, #FF2DFD, #40A7FF);
    }

    /* adactacion a dispositivos */
    @media (max-width: 750px) {
        .seccion-perfil-usuario .lista-datos {
            width: 100%;
        }

        .seccion-perfil-usuario .perfil-usuario-portada,
        .seccion-perfil-usuario .perfil-usuario-body {
            width: 95%;
        }

        .seccion-perfil-usuario .redes-sociales {
            position: relative;
            flex-direction: row;
            width: 100%;
            left: 0;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
            align-items: center;
            justify-content: center
        }

        .seccion-perfil-usuario .redes-sociales .boton-redes+.boton-redes {
            margin-left: 1rem;
            margin-top: 0;
        }
    }
</style>
<!--==========================
=            html            =
===========================-->
<section class="seccion-perfil-usuario">
    <div class="perfil-usuario-header">
        <div class="perfil-usuario-portada">
            </div>
        </div>
    </div>
    <div class="perfil-usuario-body">
        <div class="perfil-usuario-bio">
            <h3 class="titulo"><?php echo $extraer['nombre'] ?> <?php echo $extraer['apellidos'] ?></h3>

        </div>
        <div class="perfil-usuario-footer">
            <ul class="lista-datos">
                <li><i class="icono fas fa-user-check"></i>Nombre y apellidos: <?php echo $extraer['nombre'] ?> <?php echo $extraer['apellidos'] ?></li>
                <li><i class="icono fas fa-map-signs"></i> Direccion de usuario: <?php echo $extraer['Direccion'] ?></li>
                <li><i class="icono fas fa-building"></i> Cargo: medico/administrativo</li>
            </ul>
            <ul class="lista-datos">
                <li><i class="icono fas fa-map-marker-alt"></i> Ubicacion: Av. Manuel Fraga Iribarne, 2</li>
                <li><i class="icono fas fa-calendar-alt"></i> Fecha nacimiento: <?php echo $extraer['edad'] ?></li>
                <li><i class="icono fas fa-share-alt"></i> Email: <?php echo $extraer['email'] ?></li>
            </ul>
        </div>
        <div class="redes-sociales">
            <a href="https://www.facebook.com/madridsalud/" class="boton-redes facebook fab fa-facebook-f"><i class="icon-facebook"></i></a>
            <a href="https://twitter.com/SaludMadrid?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter"></i></a>
            <a href="https://www.instagram.com/saludcmadrid/?hl=es" class="boton-redes instagram fab fa-instagram"><i class="icon-instagram"></i></a>
        </div>
    </div>
</section>
<!--====  End of html  ====-->

<!--=============================
redes sociales fijadas en pantalla
No es necesario que copies esto!
==============================-->
<style>
    .mensaje a {
        color: inherit;
        margin-right: .5rem;
        display: inline-block;
    }
    .mensaje a:hover {
        color: #309B76;
        transform: scale(1.4)
    }
</style>
<div class="mis-redes" style="display: block;position: fixed;bottom: 1rem;left: 1rem; opacity: 0.5; z-index: 1000;">
    <div>
        <a target="_blank" href="https://www.facebook.com/madridsalud/"><i class="fab fa-facebook-square"></i></a>
        <a target="_blank" href="https://twitter.com/SaludMadrid?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fab fa-twitter"></i></a>
        <a target="_blank" href="https://www.instagram.com/saludcmadrid/?hl=es"><i class="fab fa-instagram"></i></a>
    </div>
</div>
<!--====  End of tarjeta  ====-->
</body>

</html>