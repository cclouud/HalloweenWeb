<?php
// Matriz global de usuarios
global $usuarios;
$usuarios = [
    ["Usuario" => "admin", "Contraseña" => "1234", "Email" => "admin@example.com", "Perfil" => "Administrador", "Pregunta" => "Color favorito", "Respuesta" => "Azul"],
    ["Usuario" => "user1", "Contraseña" => "abcd", "Email" => "user1@example.com", "Perfil" => "Usuario", "Pregunta" => "Comida favorita", "Respuesta" => "Pizza"],
    ["Usuario" => "user2", "Contraseña" => "xyz", "Email" => "user2@example.com", "Perfil" => "Usuario", "Pregunta" => "Animal favorito", "Respuesta" => "Perro"],
];

// Datos del usuario logueado actualmente
global $usuarioActual;
$usuarioActual = null;

// Función para registrar un nuevo usuario
function AltaUsuario($nuevoUser) {
    global $usuarios;
    $usuarios[] = [
        "Usuario" => $nuevoUser["Usuario"],
        "Contraseña" => $nuevoUser["Contraseña"],
        "Email" => $nuevoUser["Email"],
        "Perfil" => $nuevoUser["Perfil"],
        "Pregunta" => $nuevoUser["PreguntaSeguridad"], // Ajuste para la pregunta de seguridad
        "Respuesta" => $nuevoUser["RespuestaSeguridad"] // Ajuste para la respuesta de seguridad
    ];
}

// Función para cambiar la contraseña
function cambioContraseña($usuario, $nuevaContraseña, $preguntaSeguridad, $respuestaSeguridad) {
    global $usuarios;
    foreach ($usuarios as &$user) {
        if ($user['Usuario'] === $usuario && 
            $user['Pregunta'] === $preguntaSeguridad && 
            $user['Respuesta'] === $respuestaSeguridad) {
            $user['Contraseña'] = $nuevaContraseña;
            return true; // Cambio exitoso
        }
    }
    return false; // Fallo en la validación
}

// Función para almacenar los datos del usuario logueado
function currentUser($usuario) {
    global $usuarios, $usuarioActual;
    foreach ($usuarios as $user) {
        if ($user['Usuario'] === $usuario) {
            $usuarioActual = $user;
            return;
        }
    }
}

// Función para redireccionar
function redirect($url) {
    header('Location: ' . $url);
    die();
}

session_start();
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [
        ["Usuario" => "admin", "Contraseña" => "1234", "Email" => "admin@example.com", "Perfil" => "Administrador", "Pregunta" => "Color favorito", "Respuesta" => "Azul"],
        ["Usuario" => "user1", "Contraseña" => "abcd", "Email" => "user1@example.com", "Perfil" => "Usuario", "Pregunta" => "Comida favorita", "Respuesta" => "Pizza"],
        ["Usuario" => "user2", "Contraseña" => "xyz", "Email" => "user2@example.com", "Perfil" => "Usuario", "Pregunta" => "Animal favorito", "Respuesta" => "Perro"],
    ];
}
global $usuarios;
$usuarios = &$_SESSION['usuarios'];
