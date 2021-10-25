<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/script-footer.js" crossorigin="anonymous"></script>
    <link href="css/estilo-footer.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
</head>
<body>
Bienvenido <?php echo $_SESSION['email']; ?>

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
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="imagenes/portada2.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Lista de las vacunas</h1>
                        <p>consultelo mas detalladamente en el siguiente enlace</p>
                        <p><a class="btn btn-lg btn-primary" href="listado.php" role="button">consultar</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="imagenes/portada1.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Los origenes de la vacuna</h1>
                        <p>Como una vacuna consiguio erradicar la primera enfermedad contagiosa del mundo</p>
                        <p><a class="btn btn-lg btn-primary" href="http://proyectoavatar.enfermeriacomunitaria.org/vacunas/historia-de-las-vacunas" role="button">Entrar</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="imagenes/portada3.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>Cita</h1>
                        <p>para pedir cita a un paciente presiona el boton</p>
                        <p><a class="btn btn-lg btn-primary" href="calendario/index.php" role="button">calendario</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>

        </a>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img class="rounded-circle" src="imagenes/listas.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Lista de vacunas</h2>
                <p>Observe las vacunas creadas</p>
                <p><a class="btn btn-secondary" href="listado.php" role="button">Ver detalles &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle" src="imagenes/citas.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Calendario</h2>
                <p>consulta los dias que tienen citas los pacientes</p>
                <p><a class="btn btn-secondary" href="calendario/index.php" role="button">Ver el calendario &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle" src="imagenes/libro.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Historia</h2>
                <p>la historia completa en el siguiente enlace de como se desarrollo la primera vacuna</p>
                <p><a class="btn btn-secondary" href="http://proyectoavatar.enfermeriacomunitaria.org/vacunas/historia-de-las-vacunas" role="button">Ver detalles &raquo;</a></p>
            </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">La viruela. La causa de todo<span class="text-muted"></span></h2>
                <p class="lead">Esta es la viruela, la causante del terrible impacto en las civilizaciones griegas, romanas, las poblaciones nativas americanas... Nada parecía detener a esta vacuna hasta el SXVIII</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="imagenes/viruela.jpg">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Nada ni nadie parece pararle...<span class="text-muted"></span></h2>
                <p class="lead">En este siglo,habia una terrible crisis endemica con miles y miles de muertos al año, sin importar la clase social ni la riqueza.
                    Pero sin embargo, las ordeñadoras y pastoras eran inmunes a la enfermedad...pero ¿Por qué?
                </p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="imagenes/vaca.jpg">
            </div>
        </div>


        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Edward Jenner se le ocurrio una idea<span class="text-muted"></span></h2>
                <p class="lead">Fue quien se le ocurrio hacer un estudio del porque le ocurrian esto a las ordeñadoras y la gente de su entorno...
                    Solo el pudo tener la respuesta a esto, la cual dejarían a todos impresionados
                </p>
                <p><a class="btn btn-lg btn-primary" href="http://proyectoavatar.enfermeriacomunitaria.org/vacunas/historia-de-las-vacunas" role="button">Saber mas</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="imagenes/bombilla.jpg">
            </div>

        </div>
        <br>
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

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="js/holder.min.js"></script>
</body>
</html>