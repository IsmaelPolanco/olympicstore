<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olimpicstore_v3";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Fallo al conectarse: " . mysqli_connect_error());
}

if (isset($_POST["update_price"])) {
        $gameID = $_POST["game_id"];
        $newPrice = $_POST["new_price"];

        $sql = "UPDATE juegos SET precio = '$newPrice' WHERE ID_juego = '$gameID'";
        $result = mysqli_query($conn, $sql);
    }

    // Eliminar juego
    if (isset($_POST["delete_game"])) {
        $gameID = $_POST["game_id"];

        $sql = "DELETE FROM juegos WHERE ID_juego = '$gameID'";
        $result = mysqli_query($conn, $sql);
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <header>
        <div class="div_top_tienda_inicio">
            <div class="usuario"> 
                <div class="user_img"></div>

                <?php
                session_start();
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
            <a href="inicio.php" style="background-color: black; color: white;">INICIO</a>
            <a href="biblioteca.php">BIBLIOTECA</a>
            <a href="tienda.php">TIENDA</a>
        </div>
        <div class="div_general">
            <div class="banner_ps"></div>
            <div class="div_general_inicio">
                <div class="div_juegos_tienda"><img src="img/cod.png" class="imagen_juegos"><b>COD WW2</b><br> <?php
                    $sql = "SELECT precio FROM juegos WHERE ID_juego = 4";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $precio = $row["precio"];
                    echo "<p>$precio €</p>";
                    ?></div>
                <div class="div_juegos_tienda"><img src="img/hollow.png" class="imagen_juegos"><b>Hollow Knight</b><br> <?php
                    $sql = "SELECT precio FROM juegos WHERE ID_juego = 3";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $precio = $row["precio"];
                    echo "<p>$precio €</p>";
                    ?></div>
                <div class="div_juegos_tienda"><img src="img/mgs.png" class="imagen_juegos"><b>Metal Gear Solid</b><br> <?php
                    $sql = "SELECT precio FROM juegos WHERE ID_juego = 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $precio = $row["precio"];
                    echo "<p>$precio €</p>";
                    ?></div>
                <div class="div_juegos_tienda"><img src="img/sfv.png" class="imagen_juegos"><b>Street Fighter</b><br> <?php
                    $sql = "SELECT precio FROM juegos WHERE ID_juego = 2";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $precio = $row["precio"];
                    echo "<p>$precio €</p>";
                    ?></div>
            </div>
            <div class="banner_pc"></div>
            <div class="div_general_inicio">
                <div class="div_juegos_tienda"><img src="img/aitd.png" class="imagen_juegos"><b>Alone in the Dark</b><br><p>Proximamente</p></div>
                <div class="div_juegos_tienda"><img src="img/tloz.png" class="imagen_juegos"><b>The Legends of Zelda Tears of the kingdom</b><br><p>Proximamente</p></div>
                <div class="div_juegos_tienda"><img src="img/deadisland.png" class="imagen_juegos"><b>Dead Island 2</b><br><p>Proximamente</p></div>
                <div class="div_juegos_tienda"><img src="img/swjs.png" class="imagen_juegos"><b>Star Wars Jedi Survivor</b><br><p>Proximamente</p></div>
            </div>
            <div class="banner_zelda"></div>

            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/mgsVcarousel.jpg" class="d-block w-100" alt="imagen1">
                    </div>
                    <div class="carousel-item">
                        <img src="img/hollowcarousel.jpg" class="d-block w-100" alt="imagen2">
                    </div>
                    <div class="carousel-item">
                        <img src="img/street-fightercarousel.jpg" class="d-block w-100" alt="imagen3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
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

</html