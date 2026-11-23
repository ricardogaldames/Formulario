<?php

$nombre   = trim($_POST['nombre'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$errores = [];

if ($nombre === '') {
    $errores[] = 'El nombre es obligatorio.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El email no tiene un formato válido.';
}

if (strlen($password) < 8) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
}

if (count($errores) > 0) {
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Error</title></head><body>';
    foreach ($errores as $e) {
        echo '<p>' . htmlspecialchars($e, ENT_QUOTES, 'UTF-8') . '</p>';
    }
    echo '<p><a href="registro.php">Volver</a></p></body></html>';
    mysqli_close($conexion);
    exit;
}

$emailSeguro = mysqli_real_escape_string($conexion, $email);
$sqlDup = "SELECT id FROM usuarios WHERE email = '{$emailSeguro}' LIMIT 1";
$resDup = mysqli_query($conexion, $sqlDup);

if ($resDup && mysqli_fetch_assoc($resDup)) {
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Duplicado</title></head><body>';
    echo '<p>Ya existe un usuario registrado con ese email.</p>';
    echo '<p><a href="registro.php">Volver</a></p></body></html>';
    mysqli_close($conexion);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT); 
$nombreSeguro = mysqli_real_escape_string($conexion, $nombre);
$hashSeguro = mysqli_real_escape_string($conexion, $hash);

$sqlIns = "INSERT INTO usuarios (nombre, email, password, rol) 
           VALUES ('{$nombreSeguro}', '{$emailSeguro}', '{$hashSeguro}', 'usuario')";

$ok = mysqli_query($conexion, $sqlIns);

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
</head>
<body>
    <?php if ($ok): ?>
        <p><strong>Usuario registrado correctamente.</strong> La contraseña quedó encriptada.</p>
        <p><a href="login.php">Ir al login</a></p>
    <?php else: ?>
        <p>Error al registrar. Revisá MySQL y que hayas importado el SQL.</p>
        <p><a href="registro.php">Volver</a></p>
    <?php endif; ?>
</body>
</html>