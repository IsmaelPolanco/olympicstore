<?php
session_start();

if (!isset($_SESSION["ID_usuario"])) {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v3";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Fallo al conectarse: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_usuario = $_SESSION["ID_usuario"];
    $ID_juego = $_POST["ID_juego"];

    $sql = "INSERT INTO bibliotecas_juegos (ID_biblioteca, ID_juego) VALUES ('$ID_usuario', '$ID_juego')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: biblioteca.php");
    } else {
        echo "Error al agregar el juego.";
    }
}

mysqli_close($conn);
?>