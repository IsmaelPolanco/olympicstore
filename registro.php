<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro de usuarios</title>
    </head>
    <body>
        <h1>Regsitro de usuarios</h1>
        <form method="post" action="registrar.php">
            <label for="nombre">Nombre de usuario:</label>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="nickname">Nickname:</label>
            <input type="text" name="nickname" id="nickname" required>
            <br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña" required>
            <br>
            <input type="submit" value="Registrarse">
        </form>
    </body> 
</html>
