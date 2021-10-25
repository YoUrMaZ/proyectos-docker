<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mi Calendario:: Ing. Urian Viera</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css_cal/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css_cal/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css_cal/home.css">
    <script src="../js/script-footer.js" crossorigin="anonymous"></script>
    <link href="../css/estilo-footer.css" rel="stylesheet">

</head>
<body>

<?php
include('config.php');

  $SqlEventos   = ("SELECT * FROM eventoscalendar");
  $resulEventos = mysqli_query($con, $SqlEventos);

?>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
        <a href="../welcome.php">
            <img src="../imagenes/logo_principal.jpg"  height="60" width="120" >
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="text-black nav-link" href="../create.php">Crear Vacuna</a>
                </li>
                <li class="nav-item active">
                    <a class="text-black nav-link" href="../listado.php">lista de vacunas</a>
                </li>
                <li class="nav-item active">
                    <a class="text-black nav-link" href="../pacientes.php">Registrar pacientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="text-black nav-link" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="../logout.php">cerrar Sesion</a>
                    </div>
                </li>
                <li>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="mt-5"></div>

    <div class="container">
        <br/><br/><br/>
        <div class="row">
            <div class="col msjs">
                <?php
                include('msjs.php');
                ?>
            </div>
        </div>




        <div id="calendar"></div>


        <?php
        include('modalNuevoEvento.php');
        include('modalUpdateEvento.php');
        ?>



        <script src ="js_cal/jquery-3.0.0.min.js"> </script>
        <script src="js_cal/popper.min.js"></script>
        <script src="js_cal/bootstrap.min.js"></script>

        <script type="text/javascript" src="js_cal/moment.min.js"></script>
        <script type="text/javascript" src="js_cal/fullcalendar.min.js"></script>
        <script src='locales/es.js'></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#calendar").fullCalendar({
                    header: {
                        left: "prev,next today",
                        center: "title",
                        right: "month,agendaWeek,agendaDay"
                    },

                    locale: 'es',

                    defaultView: "month",
                    navLinks: true,
                    editable: true,
                    eventLimit: true,
                    selectable: true,
                    selectHelper: false,

//Nuevo Evento
                    select: function(start, end){
                        $("#exampleModal").modal();
                        $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));

                        var valorFechaFin = end.format("DD-MM-YYYY");
                        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
                        $('input[name=fecha_fin').val(F_final);

                    },

                    events: [
                        <?php
                        while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
                        {
                            _id: '<?php echo $dataEvento['id']; ?>',
                            title: '<?php echo $dataEvento['evento']; ?>',
                            start: '<?php echo $dataEvento['fecha_inicio']; ?>',
                            end:   '<?php echo $dataEvento['fecha_fin']; ?>',
                            color: '<?php echo $dataEvento['color_evento']; ?>'
                        },
                        <?php } ?>
                    ],


//Eliminar Evento
                    eventRender: function(event, element) {
                        element
                            .find(".fc-content")
                            .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");

                        //Eliminar evento
                        element.find(".closeon").on("click", function() {

                            var pregunta = confirm("Deseas Borrar este Evento?");
                            if (pregunta) {

                                $("#calendar").fullCalendar("removeEvents", event._id);

                                $.ajax({
                                    type: "POST",
                                    url: 'deleteEvento.php',
                                    data: {id:event._id},
                                    success: function(datos)
                                    {
                                        $(".alert-danger").show();

                                        setTimeout(function () {
                                            $(".alert-danger").slideUp(500);
                                        }, 3000);

                                    }
                                });
                            }
                        });
                    },


//Moviendo Evento Drag - Drop
                    eventDrop: function (event, delta) {
                        var idEvento = event._id;
                        var start = (event.start.format('DD-MM-YYYY'));
                        var end = (event.end.format("DD-MM-YYYY"));

                        $.ajax({
                            url: 'drag_drop_evento.php',
                            data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
                            type: "POST",
                            success: function (response) {
                                // $("#respuesta").html(response);
                            }
                        });
                    },

//Modificar Evento del Calendario
                    eventClick:function(event){
                        var idEvento = event._id;
                        $('input[name=idEvento').val(idEvento);
                        $('input[name=evento').val(event.title);
                        $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
                        $('input[name=fecha_fin').val(event.end.format("DD-MM-YYYY"));

                        $("#modalUpdateEvento").modal();
                    },


                });


//Oculta mensajes de Notificacion
                setTimeout(function () {
                    $(".alert").slideUp(300);
                }, 3000);


            });

        </script>
<br><br><br><br>
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
</body>
</html>