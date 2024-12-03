let canvas = document.getElementById('pong');
let ctx = canvas.getContext('2d');

// Definir a paleta (barras) e a bola
const paddleWidth = 10, paddleHeight = 60;
const ballSize = 10;
let leftPaddleY, rightPaddleY, ballX, ballY, ballSpeedX, ballSpeedY;
let leftPaddleSpeed = 0, rightPaddleSpeed = 0;
let player1Name, player2Name;
let leftPlayerScore = 0, rightPlayerScore = 0;
let winScore = 5;  // Definir a pontuação para vencer

// Função para iniciar o jogo
function startGame() {
  player1Name = document.getElementById('player1-name').value || 'Player 1';
  player2Name = document.getElementById('player2-name').value || 'Player 2';
  winScore = parseInt(document.getElementById('win-score').value) || 5; // Obtém o valor de pontos para vencer

  document.getElementById('start-screen').classList.add('hidden');
  document.getElementById('game-screen').classList.remove('hidden');
  resetGame();
  update();
}

// Função para reiniciar o jogo
function resetGame() {
  leftPaddleY = canvas.height / 2 - paddleHeight / 2;
  rightPaddleY = canvas.height / 2 - paddleHeight / 2;
  ballX = canvas.width / 2;
  ballY = canvas.height / 2;
  ballSpeedX = 4;
  ballSpeedY = 4;
  leftPlayerScore = 0;
  rightPlayerScore = 0;
  updateScore();
}

// Função para desenhar as paletas
function drawPaddles() {
  ctx.fillStyle = '#fff';
  ctx.fillRect(0, leftPaddleY, paddleWidth, paddleHeight); // Paleta esquerda
  ctx.fillRect(canvas.width - paddleWidth, rightPaddleY, paddleWidth, paddleHeight); // Paleta direita
}

// Função para desenhar a bola
function drawBall() {
  ctx.fillStyle = '#fff';
  ctx.fillRect(ballX, ballY, ballSize, ballSize); // Desenha a bola
}

// Função para atualizar a posição da bola
function updateBall() {
  ballX += ballSpeedX;
  ballY += ballSpeedY;

  // Colisão com as paredes superior e inferior
  if (ballY <= 0 || ballY + ballSize >= canvas.height) {
    ballSpeedY = -ballSpeedY;
  }

  // Colisão com as paletas
  if (
    ballX <= paddleWidth && ballY + ballSize > leftPaddleY && ballY < leftPaddleY + paddleHeight ||
    ballX + ballSize >= canvas.width - paddleWidth && ballY + ballSize > rightPaddleY && ballY < rightPaddleY + paddleHeight
  ) {
    ballSpeedX = -ballSpeedX;
  }

  // Colisão com as bordas esquerda e direita
  if (ballX <= 0) {
    rightPlayerScore++;
    resetBall();
  } else if (ballX + ballSize >= canvas.width) {
    leftPlayerScore++;
    resetBall();
  }
  
  checkWinner(); // Verificar se alguém venceu
}

// Função para reiniciar a bola
function resetBall() {
  ballX = canvas.width / 2;
  ballY = canvas.height / 2;
  ballSpeedX = -ballSpeedX; // Troca a direção da bola
}

// Função para mover as paletas
function movePaddles() {
  leftPaddleY += leftPaddleSpeed;
  rightPaddleY += rightPaddleSpeed;

  // Prevenir as paletas de saírem da tela
  leftPaddleY = Math.max(0, Math.min(canvas.height - paddleHeight, leftPaddleY));
  rightPaddleY = Math.max(0, Math.min(canvas.height - paddleHeight, rightPaddleY));
}

// Função para desenhar o placar (pontuação)
function updateScore() {
  document.getElementById('score').textContent = `${player1Name}: ${leftPlayerScore} - ${player2Name}: ${rightPlayerScore}`;
}

// Função para desenhar o jogo
function drawGame() {
  ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpa o canvas
  drawPaddles(); // Desenha as paletas
  drawBall(); // Desenha a bola
  updateBall(); // Atualiza a posição da bola
  movePaddles(); // Move as paletas
  updateScore(); // Atualiza o placar
}

// Função para atualizar o jogo
function update() {
  drawGame();
  requestAnimationFrame(update); // Continuar a animação
}

// Função para verificar se alguém venceu
function checkWinner() {
  if (leftPlayerScore >= winScore) {
    showWinner(player1Name); // Mostrar vencedor
  } else if (rightPlayerScore >= winScore) {
    showWinner(player2Name); // Mostrar vencedor
  }
}

// Função para mostrar o popup de vencedor
function showWinner(winner) {
  document.getElementById('winner-text').textContent = `${winner} Wins!`;
  document.getElementById('popup').style.display = 'flex'; // Exibir o popup
}

// Função para reiniciar o jogo através do popup
function resetGameFromPopup() {
  document.getElementById('popup').style.display = 'none'; // Ocultar popup
  startGame(); // Reiniciar o jogo
}

// Função para controlar as paletas com as teclas
document.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowUp') {
    rightPaddleSpeed = -6;
  } else if (e.key === 'ArrowDown') {
    rightPaddleSpeed = 6;
  }
  if (e.key === 'w') {
    leftPaddleSpeed = -6;
  } else if (e.key === 's') {
    leftPaddleSpeed = 6;
  }
});

document.addEventListener('keyup', (e) => {
  if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
    rightPaddleSpeed = 0;
  }
  if (e.key === 'w' || e.key === 's') {
    leftPaddleSpeed = 0;
  }
});
