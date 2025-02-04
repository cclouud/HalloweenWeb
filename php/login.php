<?php
// Incluye el archivo de variables globales y funciones necesarias
include 'VarGlobales.php';
$mostrarGifError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioIngresado = $_POST['usuario'];
    $passwordIngresada = $_POST['password'];
    $encontrado = false;

    global $usuarios;
    
    foreach ($usuarios as $usuario) {
        if ($usuario['Usuario'] === $usuarioIngresado && $usuario['Contraseña'] === $passwordIngresada) {
            $encontrado = true;
            currentUser($usuarioIngresado);
            header("Location: ../html/index.html");
            exit();
        }
    }

    if (!$encontrado) {
        $mostrarGifError = true;

        // Genera el HTML y JavaScript para el audio y el GIF de error
        echo "
        <div class='gif d-flex justify-content-center align-items-center position-fixed top-50 start-50 translate-middle w-100 h-100' style='display: block;'>
            <div style='background-image: url(../img/esqueleto.gif); background-repeat: no-repeat; background-size: cover; width: 100%; height: 100%;'></div>
        </div>
        <audio id='error-sound' src='../audio/error-sound.mp3' preload='auto'></audio>
        <button id='play-sound' style='display: none;'></button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorSound = document.getElementById('error-sound');
                var playButton = document.getElementById('play-sound');
                
                playButton.addEventListener('click', function() {
                    errorSound.play().catch(function(error) {
                        console.error('No se pudo reproducir el sonido:', error);
                    });
                });
                
                // Simula un clic en el botón para activar el sonido
                playButton.click();

                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2250);
            });
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <!-- Enlaces a estilos personalizados y de Bootstrap -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-dark text-white">
    <!-- Contenedor principal para el formulario de inicio de sesión -->
    <div class="main-container d-flex align-items-center justify-content-center vh-100 position-relative">
        <!-- Superposición de fondo -->
        <div class="overlay position-fixed top-0 start-0 w-100 h-100"></div>

        <!-- Banner decorativo con imágenes de arañas -->
        <section class="banner position-absolute top-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <img src="../img/spider.png" class="spider position-absolute">
            <img src="../img/spider.png" class="spider2 position-absolute">
            <img src="../img/spider.png" class="spider3 position-absolute">
        </section>

        <!-- Formulario de inicio de sesión -->
        <div class="form-container p-4 text-center bg-black bg-opacity-75 rounded-4 shadow-lg" style="width: 400px;">
            <p class="title fs-2 text-warning" style="font-family: 'Creepster', cursive;">Medalloween</p>
            <form class="form" action="login.php" method="post">
                <!-- Campo de nombre de usuario -->
                <div class="mb-3">
                    <input type="text" name="usuario" id="usuario" class="form-control bg-dark text-light border-warning rounded-3" placeholder="Usuario" required>
                </div>
                
                <!-- Campo de contraseña -->
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control bg-dark text-white border-warning rounded-3" placeholder="Contraseña" required>
                </div>
                
                <!-- Enlace para recuperar la contraseña -->
                <p class="page-link text-end">
                    <a href="cambioPass.php" class="page-link-label text-warning">¿Has olvidado la contraseña?</a>
                </p>
                
                <!-- Botón de envío para iniciar sesión -->
                <button type="submit" class="form-btn btn btn-warning w-100 my-2 rounded-3">Iniciar sesión</button>
            </form>

            <!-- Enlace para registrarse si no tiene cuenta -->
            <p class="sign-up-label mt-3">
                ¿Aún no tienes una cuenta? <a href="altaUsuario.php" class="sign-up-link text-warning">Registrarse</a>
            </p>

            <!-- Botones para iniciar sesión con Apple y Google -->
            <div class="buttons-container mt-3">
                <button class="apple-login-button btn btn-outline-warning w-100 mb-2 rounded-3">Inicia sesión con Apple</button>
                <button class="google-login-button btn btn-outline-warning w-100 rounded-3">Inicia sesión con Google</button>
            </div>
        </div>
    </div>
</body>
</html>
