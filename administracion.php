<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>OLYMPIC STORE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <style>
            h2 {
                margin-left: 10%;
            }
            body {
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "olimpicstore_v3";

        // Establecer conexión con la base de datos
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Fallo al conectarse: " . mysqli_connect_error());
        }

        // Actualizar el precio del juego
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_price"])) {
            $gameID = $_POST["game_id"];
            $newPrice = $_POST["new_price"];

            $sql = "UPDATE juegos SET precio = '$newPrice' WHERE ID_juego = '$gameID'";
            if (mysqli_query($conn, $sql)) {
                echo "El precio del juego se actualizó correctamente.";
            } else {
                echo "Error al actualizar el precio del juego: " . mysqli_error($conn);
            }
        }

        // Eliminar un juego
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_game"])) {
            $gameID = $_POST["game_id"];

            $sql = "DELETE FROM juegos WHERE ID_juego = '$gameID'";
            if (mysqli_query($conn, $sql)) {
                echo "El juego se eliminó correctamente.";
            } else {
                echo "Error al eliminar el juego: " . mysqli_error($conn);
            }
        }
        ?>
        <h2>Actualizar precio del juego</h2>
        <div class="div_general_admin">
            <form method="POST" action="">
                <label>ID del juego:</label>
                <input type="number" name="game_id" required><br><br>
                <label>Nuevo precio:</label>
                <input type="number" step="0.01" name="new_price" required>
                <button type="submit" name="update_price">Actualizar precio</button>
            </form>
        </div>
        <h2>Eliminar juego</h2>
        <div class="div_general_admin">
            <form method="POST" action="">
                <label>ID del juego:</label>
                <input type="number" name="game_id" required>
                <button type="submit" name="delete_game">Eliminar juego</button>
            </form>
        </div>
    </body>
</html>
