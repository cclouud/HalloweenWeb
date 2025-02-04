// Obtener el canvas y su contexto para el juego
const canvas2 = document.getElementById("juegos2");
const ctx2 = canvas2.getContext("2d");

// Variables de control del juego
let isPlaying = false; // Estado del juego
let score = 0; // Puntuación
let obstacleSpeedMultiplier = 1; // Multiplicador de velocidad para aumentar la dificultad
let frameCount = 0; // Contador de cuadros
let gameOver = false; // Estado de fin del juego

// Variables del dinosaurio (esqueleto)
let dinoY = canvas2.height - 50; // Posición vertical inicial del dinosaurio
let dinoVelocityY = 0; // Velocidad vertical del dinosaurio
let isJumping = false; // Estado de salto

// Constantes físicas del juego
const gravity = 0.5; // Gravedad
const jumpStrength = -10; // Fuerza de salto

// Elemento botón para iniciar el juego
const botonJugar2 = document.getElementById("botonJugar2");
botonJugar2.addEventListener("click", startDinoGame);

// Imagen del dinosaurio
const dinoImage = new Image();
dinoImage.src = "../img/esqueleto.png"; // Imagen del dinosaurio

// Clase para los obstáculos
class Obstacle {
    constructor(x, width, height, speed) {
        this.x = x; // Posición horizontal
        this.width = width; // Ancho
        this.height = height; // Altura
        this.y = canvas2.height - height; // Posición vertical
        this.baseSpeed = speed; // Velocidad base
        this.speed = this.baseSpeed * obstacleSpeedMultiplier; // Velocidad ajustada con el multiplicador
    }

    update() {
        this.x -= this.speed; // Movimiento del obstáculo hacia la izquierda
    }

    draw() {
        ctx2.fillStyle = "red"; // Color del obstáculo
        ctx2.fillRect(this.x, this.y, this.width, this.height); // Dibujo del obstáculo
    }

    updateSpeed() {
        this.speed = this.baseSpeed * obstacleSpeedMultiplier; // Ajuste de velocidad cuando aumenta la dificultad
    }
}

const obstacles = []; // Arreglo para almacenar los obstáculos
const clouds = []; // Arreglo para almacenar las nubes decorativas
const maxObstacles = 3; // Número máximo de obstáculos en pantalla

// Función para crear un obstáculo aleatorio
function createRandomObstacle() {
    if (obstacles.length < maxObstacles && (obstacles.length === 0 || obstacles[obstacles.length - 1].x < canvas2.width - 150)) {
        const width = 15 + Math.random() * 15;
        const height = 20 + Math.random() * 30;
        const x = canvas2.width;
        const speed = 2 + Math.random();
        obstacles.push(new Obstacle(x, width, height, speed));
    }
}

// Crear nubes iniciales decorativas
function createInitialClouds() {
    for (let i = 0; i < 5; i++) {
        const width = 50 + Math.random() * 50;
        const height = 20 + Math.random() * 10;
        const x = Math.random() * canvas2.width;
        const y = Math.random() * (canvas2.height / 2);
        const speed = 0.5 + Math.random() * 0.5;
        clouds.push(new Cloud(x, y, width, height, speed));
    }
}

// Función para actualizar la puntuación y aumentar la velocidad de los obstáculos
function updateScoreAndSpeed() {
    frameCount++;
    if (frameCount % 5 === 0) {
        score++; // Incrementa la puntuación cada 5 cuadros
    }

    if (score % 200 === 0 && score > 0) { // Aumenta la dificultad cada 200 puntos
        obstacleSpeedMultiplier += 0.05;
        obstacles.forEach(obstacle => obstacle.updateSpeed());
    }
}

// Función para mostrar la puntuación en pantalla
function drawScore() {
    ctx2.fillStyle = "white";
    ctx2.font = "16px Arial";
    ctx2.fillText(`Puntuación: ${score}`, 10, 30);
}

// Inicialización de obstáculos y nubes
createRandomObstacle();
createInitialClouds();

// Función para iniciar el juego
function startDinoGame() {
    if (!isPlaying) {
        isPlaying = true;
        initGame();
    }
}

// Configuración inicial del juego
function initGame() {
    console.log("¡El juego ha comenzado!");
    gameOver = false;
    score = 0;
    obstacleSpeedMultiplier = 1;
    frameCount = 0;
    obstacles.length = 0;
    createRandomObstacle();

    // Evento de teclado para hacer saltar al dinosaurio
    document.addEventListener("keydown", (e) => {
        if (e.code === "Space" && !isJumping && !gameOver) {
            dinoVelocityY = jumpStrength;
            isJumping = true;
        }
    });

    setInterval(createRandomObstacle, 2000); // Genera obstáculos cada 2 segundos

    requestAnimationFrame(gameLoop); // Inicia el ciclo del juego
}

// Función para reiniciar el juego
function resetGame() {
    isPlaying = true;
    gameOver = false;
    score = 0;
    obstacleSpeedMultiplier = 1;
    frameCount = 0;
    dinoY = canvas2.height - 50;
    dinoVelocityY = 0;
    obstacles.length = 0; // Limpia obstáculos existentes
    createRandomObstacle();
    gameLoop(); // Reinicia el ciclo del juego
}

// Función para verificar colisiones con obstáculos
function checkCollision(obstacle) {
    const dinoWidth = 30;
    const dinoHeight = 50;
    const dinoX = 65;
    const dinoYAdjusted = dinoY + 10;

    const obstacleXAdjusted = obstacle.x + 8;
    const obstacleWidthAdjusted = obstacle.width - 16;
    const obstacleHeightAdjusted = obstacle.height - 16;

    return (
        dinoX < obstacleXAdjusted + obstacleWidthAdjusted &&
        dinoX + dinoWidth > obstacleXAdjusted &&
        dinoYAdjusted < obstacle.y + obstacleHeightAdjusted &&
        dinoYAdjusted + dinoHeight > obstacle.y
    );
}

// Ciclo principal del juego
function gameLoop() {
    ctx2.clearRect(0, 0, canvas2.width, canvas2.height); // Limpia el canvas

    // Actualiza y dibuja las nubes
    clouds.forEach(cloud => {
        cloud.update();
        cloud.draw();
    });

    // Actualiza posición y estado del dinosaurio
    dinoY += dinoVelocityY;
    dinoVelocityY += gravity;
    if (dinoY >= canvas2.height - 50) {
        dinoY = canvas2.height - 50;
        dinoVelocityY = 0;
        isJumping = false;
    }

    ctx2.drawImage(dinoImage, 50, dinoY - 10, 50, 70); // Dibuja el dinosaurio

    // Actualiza y dibuja cada obstáculo, verificando colisiones
    obstacles.forEach((obstacle, index) => {
        obstacle.update();
        obstacle.draw();

        if (checkCollision(obstacle)) {
            gameOver = true;
        }

        if (obstacle.x + obstacle.width < 0) {
            obstacles.splice(index, 1); // Elimina obstáculos fuera de pantalla
        }
    });

    updateScoreAndSpeed(); // Actualiza la puntuación y velocidad
    drawScore(); // Muestra la puntuación en pantalla

    // Verifica si el juego ha terminado
    if (gameOver) {
        endGame();
    } else if (isPlaying) {
        requestAnimationFrame(gameLoop);
    }
}

// Función para finalizar el juego y mostrar mensaje
function endGame() {
    isPlaying = false;
    ctx2.fillStyle = "white";
    ctx2.font = "24px Arial";
    ctx2.fillText("Has perdido", canvas2.width / 2 - 60, canvas2.height / 2);
    ctx2.font = "16px Arial";
    ctx2.fillText("Presiona 'R' para reiniciar", canvas2.width / 2 - 70, canvas2.height / 2 + 30);

    // Agrega el evento de teclado para reiniciar
    document.addEventListener("keydown", handleRestart);
}

// Función para manejar el reinicio del juego
function handleRestart(e) {
    if (e.key === "r" || e.key === "R") {
        document.removeEventListener("keydown", handleRestart); // Elimina el evento una vez reiniciado
        resetGame();
    }
}
