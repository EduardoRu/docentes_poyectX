<!--incluye archivo y funcionalidad del archivo header -->
<?php include "./templases/header.php" ?>

<?php
//incluye archivo y funcionalidad del archivo funciones
include 'funciones.php';

//Mensaje de error
if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'El alumno ' . $_POST['nombre'] . ' ha sido agregado con éxito'
  ];

  //incluye archivo y funcionalidad del archivo config.php
  $config = include 'config.php';
  //intentamos conectarnos a la base de datos
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] .
      ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    //Informacion del alumno
    $alumno = array(
      "nombre"   => $_POST['nombre'],
      "apellido" => $_POST['apellido'],
      "email"    => $_POST['email'],
      "edad"     => $_POST['edad'],
    );
    //Consulta a la base de datos
    $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";
    //Intenta ejecutar la consulta y retorna un mensaje de retroalimentacion
    $sentencia = $conexion->prepare($consultaSQL);
    //Ejecuta la sentencia
    $sentencia->execute($alumno);
    //Captura el error y muestra el mismo
  } catch (PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include "./templases/header.php" ?>

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


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un alumno</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="edad">Edad</label>
          <input type="text" name="edad" id="edad" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "./templases/footer.php" ?>