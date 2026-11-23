<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear cuenta</h1>
<p>Los datos se envían por <strong>POST</strong> (no aparecen en la URL).</p>

<form action="procesar_registro.php" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required maxlength="100">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required maxlength="150">

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" required minlength="8">

    <button type="submit">Registrarme</button>
</form>

<div class="links">
    <a href="login.php">Ya tengo cuenta</a> ·
    <a href="index.php">Índice</a>
</div>
</body>
</html>