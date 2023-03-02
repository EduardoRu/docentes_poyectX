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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="crear.php" class="btn btn-primary mt-4">Crear alumno</a>
                <hr>
                <form method="post" class="form-inline">
                    <div class="form-group mr-3">
                        <input type="text" id="apellido" name="apellido" 
                        placeholder="Buscar por apellido" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-3"><?= $titulo ?></h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($docente && $sentencia->rowCount() > 0) {
                            foreach ($docente as $doc) {
                        ?>
                                <tr>
                                    <td><?php echo escapar($doc["id"]); ?></td>
                                    <td><?php echo escapar($doc["nombre"]); ?></td>
                                    <td><?php echo escapar($doc["apellido_paterno"]); ?></td>
                                    <td><?php echo escapar($doc["apellido_materno"]); ?></td>
                                    <td><?php echo escapar($doc["correo_electronico"]); ?></td>
                                    <td><?php echo escapar($doc["domicilio"]) ?></td>
                                    <td><?php echo escapar($doc["telefono"]) ?></td>
                                    <td><?php echo escapar($doc["escolaridad"]) ?></td>
                                    <td><?php echo escapar($doc["nombre_carrera"]) ?></td>
                                    <td>
                                        <a href="<?= 'borrar.php?id=' . escapar($fila["idAlumno"]) ?>">🗑️Borrar</a>
                                        <a href="<?= 'editar.php?id=' . escapar($fila["idAlumno"]) ?>" .>✏️Editar</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "./templases/footer.php" ?>