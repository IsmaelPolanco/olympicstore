<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v3";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
$nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
$contraseña = mysqli_real_escape_string($conn, $_POST["contraseña"]);

$sql = "SELECT * FROM usuarios WHERE nickname = '$nickname'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "Este nombre de usuario ya está en uso, elige otro nombre de usuario. ";
    echo '<a href="registro.php"> Volver al registro</a>';
} else {
    $sql = "INSERT INTO usuarios (nombre, nickname, contraseña) "
            . "VALUES ('$nombre', '$nickname', '$contraseña')";

    if (mysqli_query($conn, $sql)) {
        echo '<p>¡Te has registrado correctamente! Haz click <a href="login.php"> aquí</a> para volver al inicio de sesión. </p>';
    } else {
        echo "Hubo un error al registrar el usuario: " . mysqli_error($conn);
        echo '<a href="login.php"> Volver al inicio de sesión</a>';
    }
}

mysqli_close($conn);
?>
