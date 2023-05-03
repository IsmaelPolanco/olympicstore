<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v2";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Fallo al conectarse: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST["nickname"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM usuarios WHERE nickname = '$nickname' AND contraseña = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["ID_usuario"] = $row["ID_usuario"];
        $_SESSION["nickname"] = $row["nickname"];

        // Obtener ID de usuario
        $ID_usuario = $_SESSION["ID_usuario"];

        // Obtener datos del juego del formulario
        $ID_juego = $_POST["ID_juego"];
        $nombre = $_POST["nombre"];
        $PEGI = $_POST["PEGI"];
        $descripcion = $_POST["descripcion"];

        // Insertar juego en la tabla juegos
        $sql = "INSERT INTO juegos (ID_juego, nombre, PEGI, descripcion ) VALUES ('$ID_juego', '$nombre', '$PEGI', '$descripcion')";
        $result = mysqli_query($conn, $sql);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID_juego = $_POST["ID_juego"];
            $ID_usuario = $_POST["ID_usuario"];

            $sql = "INSERT INTO bibliotecas_juegos(ID_biblioteca,ID_juego) VALUES ($ID_usuario,$ID_juego)";
            $result = mysqli_query($conn, $sql);
        }
    }

    if ($result) {
        // Redireccionar a la página de inicio
        header("location: biblioteca.php");

        $sql = "INSERT INTO bibliotecas_juegos(ID_biblioteca,ID_juego) VALUES ($ID_usuario,1); 
               INSERT INTO bibliotecas_juegos(ID_biblioteca,ID_juego) VALUES ($ID_usuario,2); 
               INSERT INTO bibliotecas_juegos(ID_biblioteca,ID_juego) VALUES ($ID_usuario,3); 
               INSERT INTO bibliotecas_juegos(ID_biblioteca,ID_juego) VALUES ($ID_usuario,4);";
        $result = mysqli_multi_query($conn, $sql);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>OLYMPIC STORE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        
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
        <div class="menu_tienda">
            <a href="inicio.php">INICIO</a>
            <a href="biblioteca.php">BIBLIOTECA</a>
            <a href="tienda.php" style="background-color: black; color: white;">TIENDA</a>
        </div>
        <div class="div_general">
            <h1>ULTIMAS NOVEDADES</h1>
            <div class="div_general_tienda">

                <!-- Formulario para el juego 1 -->
                <form action="añadirjuego.php" method="post">
                    <div class="div_juegos_tienda">
                        <img src="img/metargearsolid.jpg" class="imagen_juegos">
                        <b>Metal Gear Solid</b><br>
                        <p>29.99€</p>
                        <input type="hidden" name="ID_juego" value="1">
                        <button type="submit">Agregar al carrito</button>
                    </div>
                </form>

                <!-- Formulario para el juego 2 -->
                <form action="añadirjuego.php" method="post">
                    <div class="div_juegos_tienda">
                        <img src="img/street-fighter.jpg" class="imagen_juegos">
                        <b>Street Fighter</b><br>
                        <p>29.99€</p>
                        <input type="hidden" name="ID_juego" value="2">
                        <button type="submit">Agregar al carrito</button>
                    </div>
                </form>

                <!-- Formulario para el juego 3 -->
                <form action="añadirjuego.php" method="post">
                    <div class="div_juegos_tienda">
                        <img src="img/hollowknight.jpg" class="imagen_juegos">
                        <b>Hollow Knight</b><br>
                        <p>15.50€</p>
                        <input type="hidden" name="ID_juego" value="3">
                        <button type="submit">Agregar al carrito</button>
                    </div>
                </form>
                
                <form action="añadirjuego.php" method="post">
                    <div class="div_juegos_tienda">
                        <img src="img/ww2.jpg" class="imagen_juegos">
                        <b>Call Of Duty WW2</b><br>
                        <p>29.99€</p>
                        <input type="hidden" name="ID_juego" value="4">
                        <button type="submit">Agregar al carrito</button>
                    </div>
                </form>


            </div> 
            <div class="fondo_fijo">
                <h1>COMPRA CON TOTAL SEGURIDAD EN TU PAGINA WEB FAVORITA</h1>
            </div>
    </body>
    <footer>
        <div class="metodos_pago">
            <img src="img/paypal.png" alt="Método de pago 1">
            <img src="img/visa.png" alt="Método de pago 2">
            <img src="img/mastercard.png" alt="Método de pago 3">
            <img src="img/gpay.jpg" alt="Método de pago 5">
            <img src="img/applepay.jpg" alt="Método de pago 6">
        </div>
    </footer>
</html>
