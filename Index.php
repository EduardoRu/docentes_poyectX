    <?php
    include 'funciones.php';
    session_start();
    $error = false;
    $config = include 'config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        if (isset($_POST['apellido'])) {
            //$consultaSQL = "SELECT * FROM candidatos_docentes WHERE apellido LIKE
            // '%" . $_POST['apellido'] . "%'";
        } else {
            $consultaSQL = "SELECT candidatos_docentes.*, carrera.nombre_carrera AS 'nombre_carrera' FROM candidatos_docentes 
            INNER JOIN carrera 
            ON candidatos_docentes.id_Carrera = carrera.id";
        }

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $docente = $sentencia->fetchAll();
    } catch (PDOException $error) {
        $error = $error->getMessage();
    }

    $titulo = isset($_POST['apellido']) ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';
    ?>

    <?php include "./templases/header.php" ?>

    <?php
    if ($error) {
    ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!--Funcion filtro -->

    <body id="page-top">
        <div id="wrapper">
            <?php include('./templases/sidebar.php'); ?>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php include('./templases/nav.php'); ?>

                    <!-- Comienzo de cuerpo de la pagina web -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Adminstración de candiatos a docentes</h1>
                        </div>

                        <div class="row">

                            <div class="col-xl-12 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Docentes</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div>
                                            Tabla con docentes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </body>
    <?php include "./templases/footer.php" ?>