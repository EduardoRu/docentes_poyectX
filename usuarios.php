<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include 'funciones.php';
    $error = false;
    $config = include 'config.php';
    $pagina = 'usuario';
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        if (isset($_POST['buscarBuscar'])) {
            $consultaSQL = "SELECT * FROM usuario WHERE nombre LIKE '%" . $_POST['buscarNombre'] . "%'";
        } else {
            $consultaSQL = "SELECT * FROM usuario";
        }

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $usuario = $sentencia->fetchAll();

        if ($sentencia->rowCount() > 0) {
            foreach ($usuario as $user) {
                if (isset($_POST['editar_usuario_' . $user['id']])) {
                    try {

                        $pass = $user['password'];

                        if(isset($_POST['pass_usuario_'.$user['id']])){
                            $pass = password_hash($_POST['pass_usuario_'.$user['id']], PASSWORD_DEFAULT);
                        }

                        $usuarioNew = [
                            'id'                    => $user['id'],
                            'nombre'                => $_POST['nomUsuario_'. $user['id']],
                            'apellido_paterno'      => $_POST['apellido_paterno_'. $user['id']],
                            'apellido_materno'      => $_POST['apellido_materno_'. $user['id']],
                            'email'                 => $_POST['email_usuario_'. $user['id']],
                            'password'              => $pass,
                            'rol'                   => $_POST['rolUsuario_'. $user['id']]
                        ];


                        $consultaSQLUpdate = "UPDATE usuario SET
                        nombre = :nombre,
                        apellido_paterno = :apellido_paterno,
                        apellido_materno = :apellido_materno,
                        email = :email,
                        password = :password,
                        rol = :rol,
                        updated_at = NOW()
                        WHERE id = :id";


                        $sentenciaUpdate = $conexion->prepare($consultaSQLUpdate);
                        $sentenciaUpdate->execute($usuarioNew);

                        header('Location: usuarios.php');
                    } catch (PDOException $error) {
                        $error = $error->getMessage();
                    }
                }
            }
        }
    } catch (PDOException $error) {
        $error = $error->getMessage();
    }

    if (isset($_POST['crear_usuario'])) {
        try {

            $pass = password_hash($_POST['pass_usuario'], PASSWORD_DEFAULT);

            $usuario = [
                'nombre'                => $_POST['nomUsuario'],
                'apellido_paterno'      => $_POST['apellido_paterno'],
                'apellido_materno'      => $_POST['apellido_materno'],
                'email'                 => $_POST['email_usuario'],
                'password'              => $pass,
                'rol'                   => $_POST['rolUsuario']
            ];

            $consultaSQLAgregar = "INSERT INTO usuario (nombre, apellido_paterno,apellido_materno, email, password, rol)";
            $consultaSQLAgregar .= "VALUES (:" . implode(", :", array_keys($usuario)). ")";


            $sentenciaAgregar = $conexion->prepare($consultaSQLAgregar);
            $sentenciaAgregar->execute($usuario);

            header('Location: usuarios.php');
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
                                        <?php include "templases/modal_crear_usuario.php" ?>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre del usuario</th>
                                                        <th>Apellido paterno</th>
                                                        <th>Apellido materno</th>
                                                        <th>Email</th>
                                                        <th>Rol</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($usuario && $sentencia->rowCount() > 0) {
                                                        foreach ($usuario as $fila) {
                                                    ?>
                                                            <tr class="text-center">
                                                                <td><?php echo escapar($fila['id']) ?></td>
                                                                <td><?php echo escapar($fila['nombre']) ?></td>
                                                                <td><?php echo escapar($fila['apellido_paterno']) ?></td>
                                                                <td><?php echo escapar($fila['apellido_materno']) ?></td>
                                                                <td><?php echo escapar($fila['email']) ?></td>
                                                                <td><?php echo escapar($fila['rol'])?></td>
                                                                <td>
                                                                    <?php include "templases/modal_usuario.php"; ?>
                                                                    <a href="borrar.php?id=<?php echo escapar($fila['id']) . '&estado=borrar_usuario' ?>" class="btn"><i class="fas fa-times"></i> Eliminar</a>
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