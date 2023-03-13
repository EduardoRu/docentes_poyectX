<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include 'funciones.php';
    $error = false;
    $config = include 'config.php';

    $pagina = 'aceptados';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        if (isset($_POST['buscarDocente'])) {
            $consultaSQL = "SELECT candidatos_docentes.*, carrera.id AS 'id_CCarrera' ,carrera.nombre_carrera AS 'nombre_carrera' FROM candidatos_docentes 
            INNER JOIN carrera 
            ON candidatos_docentes.id_Carrera = carrera.id
            WHERE nombre LIKE '%" . $_POST['nombreDocente'] . "%' AND candidatos_docentes.status = 'aceptado'";
        } else {
            $consultaSQL = "SELECT candidatos_docentes.*, carrera.id AS 'id_CCarrera' ,carrera.nombre_carrera AS 'nombre_carrera' FROM candidatos_docentes 
            INNER JOIN carrera 
            ON candidatos_docentes.id_Carrera = carrera.id WHERE candidatos_docentes.status = 'aceptado'";
        }

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $docente = $sentencia->fetchAll();

        if ($sentencia->rowCount() > 0) {
            foreach ($docente as $doc) {
                if (isset($_POST['editCandidato_' . $doc['id']])) {
                    $nuevoDocente = [
                        'id'                    => $doc['id'],
                        'nombre'                => $_POST['nomCandidato_' . $doc['id']],
                        'apellido_paterno'      => $_POST['apP_' . $doc['id']],
                        'apellido_materno'      => $_POST['apM_' . $doc['id']],
                        'correo_electronico'    => $_POST['emailCandidato_' . $doc['id']],
                        'domicilio'             => $_POST['domCandidato_' . $doc['id']],
                        'telefono'              => $_POST['telCandidato_' . $doc['id']],
                        'municipio'             => $_POST['munCandidato_' . $doc['id']],
                        'escolaridad'           => $_POST['escCandidato_' . $doc['id']],
                        'id_Carrera'            => $_POST['carreraCandidato_' . $doc['id']]
                    ];

                    $consultaSQLUpdate = "UPDATE candidatos_docentes SET
                    nombre = :nombre,
                    apellido_paterno = :apellido_paterno,
                    apellido_materno = :apellido_materno,
                    correo_electronico = :correo_electronico,
                    domicilio = :domicilio,
                    telefono = :telefono,
                    municipio = :municipio,
                    escolaridad = :escolaridad,
                    id_Carrera = :id_Carrera,
                    updated_at = NOW()
                    WHERE id = :id";

                    $sentenciaUpdate = $conexion->prepare($consultaSQLUpdate);
                    $sentenciaUpdate->execute($nuevoDocente);

                    header('Location: aceptados.php');
                }
            }
        }
    } catch (PDOException $error) {
        $error = $error->getMessage();
    }

    $titulo = isset($_POST['buscarDocente']) ? 'Lista de docentes (' . $_POST['nombreDocente'] . ')' : 'Lista de docentes';
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido paterno</th>
                                                        <th>Apellido materno</th>
                                                        <th>Email</th>
                                                        <th>Domicilio</th>
                                                        <th>Telefono</th>
                                                        <th>Municipio</th>
                                                        <th>Escolaridad</th>
                                                        <th>Carrera interes</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($docente && $sentencia->rowCount() > 0) {
                                                        foreach ($docente as $fila) {
                                                    ?>
                                                            <tr class="text-center">
                                                                <td><?php echo escapar($fila['id']) ?></td>
                                                                <td><?php echo escapar($fila['nombre']) ?></td>
                                                                <td><?php echo escapar($fila['apellido_paterno']) ?></td>
                                                                <td><?php echo escapar($fila['apellido_materno']) ?></td>
                                                                <td><?php echo escapar($fila['correo_electronico']) ?></td>
                                                                <td><?php echo escapar($fila['domicilio']) ?></td>
                                                                <td><?php echo escapar($fila['telefono']) ?></td>
                                                                <td><?php echo escapar($fila['municipio']) ?></td>
                                                                <td><?php echo escapar($fila['escolaridad']) ?></td>
                                                                <td><?php echo escapar($fila['nombre_carrera']) ?></td>
                                                                <td>
                                                                    <?php include "templases/modal_candidatos.php"; ?>
                                                                    <br>
                                                                    <a href="borrar.php?id=<?php echo escapar($fila['id']).'&estado=borrar' ?>" class="btn"><i class="fas fa-times"></i> Eliminar</a>
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
    }else{
        header("Location: ./login.php");
        exit;
    } ?>