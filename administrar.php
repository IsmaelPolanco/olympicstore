<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v3";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];

    if ($password === "1234") {
        $_SESSION["intentos"] = 0;
        header("Location: administracion.php");
        exit;
    } else {
        if (isset($_SESSION["intentos"])) {
            $_SESSION["intentos"]++;
        } else {
            $_SESSION["intentos"] = 1;
        }
        if ($_SESSION["intentos"] >= 3) {
            session_destroy();
            header("Location: login.php");
            exit;
        }

        $mensajeError = "Contraseña incorrecta. Inténtelo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrar Página</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body{
                margin-top: 10%;
            }
            div{
                height: 200px;
                margin-left: 10%;
                width: 80%;
                justify-content: space-around;
                display: flex;
                align-items: center;
                text-align: center;
                flex-direction: row;
                flex-flow: wrap;
                color: white;
                background-color: green;
                text-decoration: none;
                font-size: 20px;
                border-radius: 20px;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>Ingrese la contraseña para administrar la página</h1>
            <?php
            if (isset($mensajeError)) {
                echo "<p>$mensajeError</p>";
            }
            ?>
            <form method="POST" action="administracion.php">
                <input type="password" name="password" required>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </body>
</html>
