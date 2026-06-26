<?php

/*
  Para funcionar o script
  NO MYSQL WORKBEACH digitar os comandos:
  CREATE DATABASE catjogos;
  USE catjogos;
  Digitar as informações do arquivo do word no MYSQL

  certifique-se que o serviços do mysql e php estão startados no xamp
  Esse script primeiro.php
  Salvar no C:\xampp\htdocs
  Abrir o Browser de preferencia
  http://localhost/primeiro.php

*/

$host = "localhost";
$user = "root";
$pass = "";
$db   = "catjogos";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$msg = "";

/*
|--------------------------------------------------------------------------
| EXCLUIR
|--------------------------------------------------------------------------
*/
if(isset($_GET['excluir']))
{
    $id = $_GET['excluir'];

    $sql = "DELETE FROM jogo WHERE id = $id";

    if($conn->query($sql))
    {
        $msg = "Jogo excluído com sucesso!";
    }
}

/*
|--------------------------------------------------------------------------
| CADASTRAR
|--------------------------------------------------------------------------
*/
if(isset($_POST['salvar']))
{
    $nome = $_POST['nome'];
    $plataforma = $_POST['plataforma'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $sql = "
        INSERT INTO jogo
        (
            nome,
            plataforma,
            genero,
            ano
        )
        VALUES
        (
            '$nome',
            '$plataforma',
            '$genero',
            '$ano'
        )
    ";

    if($conn->query($sql))
    {
        $msg = "Jogo cadastrado com sucesso!";
    }
}

/*
|--------------------------------------------------------------------------
| PESQUISA
|--------------------------------------------------------------------------
*/
$filtro = "";

if(isset($_GET['pesquisar']))
{
    $texto = $_GET['texto'];

    $filtro = " WHERE nome LIKE '%$texto%' ";
}

$sql = "
    SELECT
        id,
        nome,
        plataforma,
        genero,
        ano
    FROM jogo
    $filtro
    ORDER BY nome
";

$lista = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Jogos</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:linear-gradient(135deg,#0f172a,#1e293b);
    min-height:100vh;
    padding:30px;
}

.container{
    max-width:1100px;
    margin:auto;
}

.titulo{
    color:white;
    text-align:center;
    margin-bottom:25px;
    font-size:40px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    margin-bottom:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

input{
    width:100%;
    padding:12px;
    margin-top:10px;
    margin-bottom:10px;
    border:1px solid #ddd;
    border-radius:8px;
}

button{
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    color:white;
    font-weight:bold;
}

.btn-salvar{
    background:#16a34a;
}

.btn-pesquisar{
    background:#2563eb;
}

.btn-excluir{
    background:#dc2626;
    text-decoration:none;
    padding:8px 12px;
    border-radius:6px;
    color:white;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#1e293b;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

.msg{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

.info{
    display:flex;
    gap:10px;
}

.info input{
    flex:1;
}

</style>

</head>
<body>

<div class="container">

    <h1 class="titulo">
        🎮 Cadastro de Jogos
    </h1>

    <?php if($msg != "") { ?>

        <div class="msg">
            <?php echo $msg; ?>
        </div>

    <?php } ?>

    <div class="card">

        <h2>Novo Jogo</h2>

        <form method="post">

            <input
                type="text"
                name="nome"
                placeholder="Nome do jogo"
                required
            >

            <input
                type="text"
                name="plataforma"
                placeholder="Plataforma"
                required
            >

            <input
                type="text"
                name="genero"
                placeholder="Gênero"
                required
            >

            <input
                type="text"
                name="ano"
                placeholder="ano"
                required
            >

            <button
                type="submit"
                name="salvar"
                class="btn-salvar"
            >
                Salvar Jogo
            </button>

        </form>

    </div>

    <div class="card">

        <h2>Pesquisar</h2>

        <form method="get">

            <div class="info">

                <input
                    type="text"
                    name="texto"
                    placeholder="Digite o nome do jogo"
                >

                <button
                    type="submit"
                    name="pesquisar"
                    class="btn-pesquisar"
                >
                    Pesquisar
                </button>

            </div>

        </form>

    </div>

    <div class="card">

        <h2>Lista de Jogos</h2>

        <br>

        <table>

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Plataforma</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>Ação</th>
            </tr>

            <?php while($row = $lista->fetch_assoc()) { ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['nome']; ?></td>

                    <td><?php echo $row['plataforma']; ?></td>

                    <td><?php echo $row['genero']; ?></td>

                    <td><?php echo $row['ano']; ?></td>


                    <td>

                        <a
                            class="btn-excluir"
                            href="?excluir=<?php echo $row['id']; ?>"
                            onclick="return confirm('Deseja excluir?')"
                        >
                            Excluir
                        </a>

                    </td>

                </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>