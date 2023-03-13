<?php
session_start();
$config = include 'config.php';

if (isset($_POST['emailAdmin']) && isset($_POST['passAdmin'])) {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $email = $_POST['emailAdmin'];
    $password = $_POST['passAdmin'];

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$email]);

    if ($sentencia->rowCount() == 1) {
        $user = $sentencia->fetch();

        $uemail = $user['email'];
        $upassword = $user['password'];
        $name = $user['nombre'];
        $rol = $user['rol'];
        $id = $user['id'];

        if ($uemail === $email) {
            if (password_verify($password, $upassword)) {

                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $name;
                $_SESSION['rol'] = $rol;

                header("Location: ./index.php");
                exit;
            }else{
                header("Location: ./login.php");
                exit;
            }
        }
    }
} else {
    header("Location: ./login.php");
    exit;
}
?>