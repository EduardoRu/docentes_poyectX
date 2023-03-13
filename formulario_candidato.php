<?php
include 'funciones.php';
$error = false;
$config = include 'config.php';

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $consultaSQLCarreras = "SELECT * FROM carrera";
    $sentenciaCarreras = $conexion->prepare($consultaSQLCarreras);
    $sentenciaCarreras->execute();

    $carreras = $sentenciaCarreras->fetchAll();
} catch (PDOException $error) {
    $error = $error->getMessage();
}


if (isset($_POST['datosDocente'])) {
    $resultado = [
        'error' => false,
        'mensaje' => 'Tus datos han sido registrados exitosamente, nos pondremos en contacto contigo, gracias!!'
    ];
    try {

        $datosdocente = [
            'nombre'                => $_POST['nomCandidato'],
            'apellido_paterno'      => $_POST['apP'],
            'apellido_materno'      => $_POST['apM'],
            'correo_electronico'    => $_POST['emailCandidato'],
            'domicilio'             => $_POST['domCandidato'],
            'telefono'              => $_POST['telCandidato'],
            'municipio'             => $_POST['munCandidato'],
            'escolaridad'           => $_POST['escCandidato'],
            'id_Carrera'            => $_POST['carreraCandidato']
        ];

        $consultaSQLAgregar = "INSERT INTO candidatos_docentes (nombre, apellido_paterno, apellido_materno, correo_electronico, domicilio, telefono, municipio, escolaridad, id_Carrera)";
        $consultaSQLAgregar.= "VALUES (:" . implode(", :", array_keys($datosdocente)) . ")";

        $sentenciaAgregar = $conexion->prepare($consultaSQLAgregar);
        $sentenciaAgregar->execute($datosdocente);

    } catch (PDOException $error) {
        $resultado = [
            'error' => true,
            'mensaje' => 'Ha ocurrido un error al enviar los datos'
        ];
    }
}
?>
<?php include "templases/header.php" ?>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand bg-gradient-primary topbar mb-4 static-top">
                    <a class="navbar-brand text-white" href="formulario_candidato.php">Inicio</a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link " href="login.php" role="button">
                                <i class="mr-2 d-lg-inline fas fa-user fa-sm text-white"></i>
                                <span class="mr-2 d-none d-lg-inline text-white">Inicia sesión</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="container">
                <div class="text-center mb-4">
                    <h3>Favor de ingresar sus datos si esta interesado en ser docente</h3>
                    <?php
                    if (isset($resultado)) {
                    ?>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                                        <?= $resultado['mensaje'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Nombre del candidato</label>
                        <input type="text" class="form-control" id="nomCandidato" name="nomCandidato" placeholder="Nombre o nombres" required>
                    </div>
                    <label for="">Apellido paterno y materno</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="apP" name="apP" placeholder="Apellido paterno" required>
                        <input type="text" class="form-control" id="apM" name="apM" placeholder="Apellido materno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Correo electronico</label>
                        <input type="email" class="form-control" id="emailCandidato" name="emailCandidato" placeholder="Email del candidato" required>
                    </div>
                    <div class="form-group">
                        <label for="">Domicilio</label>
                        <input type="text" class="form-control" id="domCandidato" name="domCandidato" placeholder="Domicilio del candidato" required>
                    </div>
                    <div class="form-group">
                        <label for="">Telefono</label>
                        <input type="number" class="form-control" id="telCandidato" name="telCandidato" placeholder="Telefono del candidato" required>
                    </div>
                    <div class="form-group">
                        <label for="">Municipio</label>
                        <input type="text" class="form-control" id="munCandidato" name="munCandidato" placeholder="Municipio del candidato" required>
                    </div>
                    <div class="form-group">
                        <label for="">Escolaridad</label>
                        <input type="text" class="form-control" id="escCandidato" name="escCandidato" placeholder="Escolaridad del candidato" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Carrera de interes </label>
                        <select name="carreraCandidato" id="carreraCandidato" class="form-select">
                            <option value=""></option>
                            <?php
                            foreach ($carreras as $car) {
                            ?>
                                <option value="<?= escapar($car['id']) ?>"><?php echo escapar($car['nombre_carrera']) ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="datosDocente" name="datosDocente">Enviar mis datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include "templases/footer.php" ?>