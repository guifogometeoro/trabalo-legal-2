<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jogo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SALVAR PONTUAÇÃO
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $pontos = intval($_POST['pontos']);
    $sql = "INSERT INTO ranking (nome, pontos) VALUES ('$nome', $pontos)";
    $conn->query($sql);
}

// BUSCAR RANKING
$sql = "SELECT nome, pontos FROM ranking ORDER BY pontos DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Jogo das Bolinhas</title>
<style>
body {
    text-align: center;
    font-family: Arial;
    background: #222;
    color: white;
}
#game {
    position: relative;
    width: 400px;
    height: 500px;
    margin: auto;
    background: black;
    overflow: hidden;
    border: 3px solid white;
}
.ball {
    width: 20px;
    height: 20px;
    background: red;
    border-radius: 50%;
    position: absolute;
}
#player {
    width: 80px;
    height: 15px;
    background: lime;
    position: absolute;
    bottom: 0;
}
table {
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    color: black;
}
td, th {
    border: 1px solid black;
    padding: 8px;
}
</style>
</head>
<body>

<h1>🎮 Jogo das Bolinhas</h1>
<p>Pontos: <span id="score">0</span> | Erros: <span id="miss">0</span></p>

<div id="game">
    <div id="player"></div>
</div>

<form id="form" method="POST" style="display:none;">
    <h2>Perdeu Mane!</h2>
    <input type="text" name="nome" placeholder="Seu Nome" required>
    <input type="hidden" name="pontos" id="finalScore">
    <button type="submit">Salvar</button>
</form>

<h2>🏆 Ranking</h2>
<table>
<tr><th>Nome</th><th>Pontos</th></tr>
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nome"]."</td><td>".$row["pontos"]."</td></tr>";
    }
}
?>
</table>

<script>
const game = document.getElementById("game");
const player = document.getElementById("player");
const scoreSpan = document.getElementById("score");
const missSpan = document.getElementById("miss");
const form = document.getElementById("form");
const finalScore = document.getElementById("finalScore");

let playerX = 160;
let score = 0;
let miss = 0;
let speed = 2;
let balls = [];

player.style.left = playerX + "px";

document.addEventListener("mousemove", (e) => {
    const rect = game.getBoundingClientRect();
    playerX = e.clientX - rect.left - 40;
    if (playerX < 0) playerX = 0;
    if (playerX > 320) playerX = 320;
    player.style.left = playerX + "px";
});

function createBall() {
    const ball = document.createElement("div");
    ball.classList.add("ball");
    ball.style.left = Math.random() * 380 + "px";
    ball.style.top = "0px";
    game.appendChild(ball);
    balls.push(ball);
}

function updateGame() {
    balls.forEach((ball, index) => {
        let top = parseFloat(ball.style.top);
        ball.style.top = top + speed + "px";

        if (top > 480) {
            miss++;
            missSpan.innerText = miss;
            game.removeChild(ball);
            balls.splice(index, 1);
        }

        let ballX = parseFloat(ball.style.left);
        if (top > 460 && ballX > playerX && ballX < playerX + 80) {
            score++;
            speed += 0.2;
            scoreSpan.innerText = score;
            game.removeChild(ball);
            balls.splice(index, 1);
        }
    });

    if (miss >= 3) {
        endGame();
    }
}

function endGame() {
    clearInterval(gameLoop);
    finalScore.value = score;
    form.style.display = "block";
}

setInterval(createBall, 1000);
const gameLoop = setInterval(updateGame, 20);
</script>

</body>
</html>

<?php $conn->close(); ?>