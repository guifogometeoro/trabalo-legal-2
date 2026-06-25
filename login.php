<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "demologin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$mensagem = "";

/* =========================
   CADASTRAR USUÁRIO
========================= */
if (isset($_POST['cadastrar'])) {
    $nome  = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (nome, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $senha);

    if ($stmt->execute()) {
        $mensagem = "<div class='success'>Usuário cadastrado com sucesso!</div>";
    } else {
        $mensagem = "<div class='error'>Erro ao cadastrar.</div>";
    }
    $stmt->close();
}

/* =========================
   LOGIN
========================= */
if (isset($_POST['login'])) {
    $nome  = $_POST['nome'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $nome;
            $mensagem = "<div class='success'>Login realizado com sucesso!</div>";
        } else {
            $mensagem = "<div class='error'>Senha incorreta.</div>";
        }
    } else {
        $mensagem = "<div class='error'>Usuário não encontrado.</div>";
    }

    $stmt->close();
}

/* =========================
   EXCLUIR USUÁRIO
========================= */
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: login.php");
    exit;
}

$resultUsuarios = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Sistema Completo</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }

body {
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    min-height:100vh;
    padding:40px;
    color:#fff;
}

.container {
    max-width:1000px;
    margin:auto;
    backdrop-filter: blur(15px);
    background: rgba(255,255,255,0.08);
    padding:40px;
    border-radius:20px;
    box-shadow:0 25px 45px rgba(0,0,0,0.3);
}

h2 { margin-bottom:20px; }

form {
    display:flex;
    gap:10px;
    margin-bottom:20px;
}

input {
    padding:10px;
    border-radius:8px;
    border:none;
    width:200px;
}

button {
    padding:10px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.login-btn { background:#00c6ff; color:#fff; }
.cad-btn { background:#00b894; color:#fff; }

button:hover { opacity:0.8; }

table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    background: rgba(255,255,255,0.1);
    border-radius:10px;
    overflow:hidden;
}

th, td {
    padding:12px;
    text-align:center;
}

th {
    background: rgba(0,0,0,0.3);
}

tr:nth-child(even) {
    background: rgba(255,255,255,0.05);
}

a.delete {
    background:#d63031;
    color:#fff;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
}

.success, .error {
    margin-bottom:15px;
    padding:10px;
    border-radius:8px;
}

.success { background:#00b894; }
.error { background:#d63031; }

.footer {
    margin-top:30px;
    text-align:center;
    font-size:12px;
    opacity:0.7;
}
</style>
</head>

<body>

<div class="container">

<h2>🔐 Sistema de Login + CRUD</h2>

<?php echo $mensagem; ?>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit" name="login" class="login-btn">Login</button>
    <button type="submit" name="cadastrar" class="cad-btn">Cadastrar</button>
</form>

<h2>📋 Usuários Cadastrados</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ação</th>
    </tr>

    <?php while($row = $resultUsuarios->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td>
            <a class="delete" href="?excluir=<?php echo $row['id']; ?>" 
               onclick="return confirm('Deseja realmente excluir?')">
               Excluir
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<div class="footer">
© <?php echo date("Y"); ?> Sistema Exemplo de Banco de Dados
</div>

</div>

</body>
</html>

<?php $conn->close(); ?>