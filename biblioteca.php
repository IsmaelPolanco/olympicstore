<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v3";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Fallo al conectarse: " . mysqli_connect_error());
}


$ID_usuario = $_SESSION["ID_usuario"];

$sql = "SELECT bibliotecas_juegos.ID_biblioteca, bibliotecas_juegos.ID_juego, juegos.nombre, juegos.PEGI, juegos.descripcion
                FROM bibliotecas_juegos 
                INNER JOIN juegos ON bibliotecas_juegos.ID_juego = juegos.ID_juego
                INNER JOIN usuarios ON bibliotecas_juegos.ID_biblioteca = usuarios.ID_biblioteca 
                WHERE usuarios.ID_usuario = $ID_usuario;
";

$imagenes = array(
    1 => 'img/metargearsolid.jpg',
    2 => 'img/street-fighter.jpg',
    3 => 'img/hollowknight.jpg',
    4 => 'img/ww2.jpg'
);

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
        <div class="div_top_tienda">
            <div class="usuario"> 
                <div class="user_img"></div>
                <?php
                if (isset($_SESSION['nickname'])) {
                    $nickname = $_SESSION['nickname'];
                    echo '<p>' . $nickname . '</p>';
                }
                ?>
            </div>
            <div class="cerrarsesion">
                <a href="Login.php"><button type="submit">Cerrar Sesión</button> </a>
            </div>
            OLYMPIC STORE
        </div>
        </header>
        <div class="menu_tienda">
            <a href="inicio.php">INICIO</a>
            <a href="biblioteca.php" style="background-color: black; color: white;">BIBLIOTECA</a>
            <a href="tienda.php">TIENDA</a>
        </div>
        <div class="div_general">
            <div class="div_general_tienda"> <br>
                <?php
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='juego'>";
                        echo "<img src='" . $imagenes[$row["ID_juego"]] . "'class='imagen_juegos'> <br>";
                        echo "<b>" . $row["nombre"] . "</b><br>";
                        echo "<p>PEGI: " . $row["PEGI"] . "</p>";
                        echo "<p>Descripción: " . $row["descripcion"] . "</p>";
                        echo "</div>";
                        echo "<hr>";
                    }
                } else {
                    echo "<p>No tienes juegos en tu biblioteca.</p>";
                }
                ?> 
            </div>
        </div>
    </body>
</html>
