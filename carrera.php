<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include 'funciones.php';
    $error = false;
    $config = include 'config.php';
    $pagina = 'carrera';
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        if (isset($_POST['buscarBuscar'])) {
            $consultaSQL = "SELECT * FROM carrera WHERE nombre_carrera LIKE '%" . $_POST['buscarNombre'] . "%'";
        } else {
            $consultaSQL = "SELECT * FROM carrera";
        }

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $carrera = $sentencia->fetchAll();

        if ($sentencia->rowCount() > 0) {
            foreach ($carrera as $car) {
                if (isset($_POST['editCarrera_' . $car['id']])) {
                    try {
                        $consultaSQLUpdate = "UPDATE carrera SET nombre_carrera = '" . $_POST['nomCarrera_' . $car['id']] . "', updated_at = NOW() WHERE id = " . $car['id'];
                        $sentenciaUpdate = $conexion->prepare($consultaSQLUpdate);
                        $sentenciaUpdate->execute();

                        header('Location: carrera.php');
                    } catch (PDOException $error) {
                        $error = $error->getMessage();
                    }
                }
            }
        }
    } catch (PDOException $error) {
        $error = $error->getMessage();
    }

    if (isset($_POST['crearCarrera'])) {
        try {
            $consultaSQLAgregar = "INSERT INTO carrera (nombre_carrera) VALUES ('" . $_POST['nomCarrera'] . "')";
            $sentenciaAgregar = $conexion->prepare($consultaSQLAgregar);
            $sentenciaAgregar->execute();

            header('Location: carrera.php');
        } catch (PDOException $error) {
            $error = $error->getMessage();
        }
    }

    $titulo = isset($_POST['buscarCarrera']) ? 'Lista de carreras (' . $_POST['nombreCarrera'] . ')' : 'Lista de carreras';
?>

    <?php include "./templases/header.php" ?>
    <!--Funcion filtro -->

    <body id="page-top">
        <div id="wrapper">
            <?php include('./templases/sidebar.php'); ?>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php include('./templases/nav.php'); ?>

                    <!-- Comienzo de cuerpo de la pagina web -->
                    <div class="container-fluid">
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
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Adminstración de carreras</h1>
                        </div>

                        <div class="row">

                            <div class="col-xl-12 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Carreras</h6>
                                        <?php include "templases/modal_crear_carrera.php" ?>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre de la carrera</th>
                                                        <th>Creación</th>
                                                        <th>Modificación</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($carrera && $sentencia->rowCount() > 0) {
                                                        foreach ($carrera as $fila) {
                                                    ?>
                                                            <tr class="text-center">
                                                                <td><?php echo escapar($fila['id']) ?></td>
                                                                <td><?php echo escapar($fila['nombre_carrera']) ?></td>
                                                                <td><?php echo escapar($fila['created_at']) ?></td>
                                                                <td><?php echo escapar($fila['updated_at']) ?></td>
                                                                <td>
                                                                    <?php include "templases/modal_carrera.php"; ?>
                                                                    <a href="borrar.php?id=<?php echo escapar($fila['id']) . '&estado=borrar_carrera' ?>" class="btn"><i class="fas fa-times"></i> Eliminar</a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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
<?php include "./templases/footer.php";
} else {
    header("Location: ./login.php");
    exit;
} ?>