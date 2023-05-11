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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST["nickname"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM usuarios WHERE nickname = '$nickname' AND contraseña = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["ID_usuario"] = $row["ID_usuario"];
        $_SESSION["nickname"] = $row["nickname"];
        header("location: inicio.php");
    } else {
        $error = "Nombre de usuario, contraseña o nickname incorrecto.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>OLIYMPIC STORE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>  
        <div class="div_top">
            OLYMPIC STORE
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="div_general">
                <div class="div_login">
                    <div class="div_login_iniciosesion">
                        <div class="div_login_logo">
                            <img class="imagen" src="logo.png">
                        </div>
                        <div class="div_login_usucon">
                            <p>Usuario: </p> <input class="usucontra" type="text" name="nickname" required=""><br><br>
                            <p>Contraseña:</p> <input class="usucontra" type="password" name="contraseña" required> <br><br>
                            <button type="submit">Login</button> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        if (!empty($error)) {
            echo '<p style="text-align: center;">' . $error . '</p>';
        }
        ?>
    </body>
</html>