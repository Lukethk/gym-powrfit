<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $contrasena = $_POST['Contrasena'];

    
    $stmt = $conn->prepare("SELECT Contrasena FROM usuarios WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($contrasena, $hashed_password)) {
        echo "Inicio de sesión exitoso";
        // Aquí puedes redirigir al usuario a otra página
         header("Location: p.html");
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }

    $stmt->close();
    $conn->close();
}
?>
