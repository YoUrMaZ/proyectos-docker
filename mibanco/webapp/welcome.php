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
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="imagenes/logo%20empresa.png">Carousel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="create.php">Crear Vacuna</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="listado.php">lista de vacunas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="pacientes.php">Registrar pacientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                        <a class="dropdown-item" href="#">Perfil</a>
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
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">consultar</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="imagenes/portada1.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Los origenes de la vacuna</h1>
                        <p>Como una vacuna consiguio erradicar la primera enfermedad contagiosa del mundo</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Entrar</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="imagenes/portada3.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>Cita</h1>
                        <p>para pedir cita a un paciente presiona el boton</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">cita</a></p>
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
                <p><a class="btn btn-secondary" href="#" role="button">Ver detalles &raquo;</a></p>
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
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Saber mas</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="imagenes/bombilla.jpg">
            </div>
        </div>
        <hr class="featurette-divider">

    </div>


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>

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