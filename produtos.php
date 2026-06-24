<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zalina";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// BUSCA
$busca = "";
if (isset($_GET['buscar'])) {
    $busca = $conn->real_escape_string($_GET['buscar']);
    $sql = "SELECT codigo, nome, preco FROM produtos 
            WHERE nome LIKE '%$busca%' 
            ORDER BY codigo ASC";
} else {
    $sql = "SELECT codigo, nome, preco FROM produtos ORDER BY codigo ASC";
}

// Execute the SQL query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Produtos</title>
<style>
body { font-family: Arial; text-align: center; }
table { margin: auto; border-collapse: collapse; width: 60%; }
th, td { border: 1px solid black; padding: 8px; }
th { background: #444; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
input { padding: 5px; }
button { padding: 6px 10px; }
</style>
</head>
<body>

<h2>📦 Lista de Produtos</h2>

<form method="GET">
    <input type="text" name="buscar" placeholder="Buscar produto" value="<?php echo $busca; ?>">
    <button type="submit">Buscar</button>
    <a href="produtos.php">Mostrar Todos</a>
</form>

<br>

<table>
<tr>
    <th>Código</th>
    <th>Nome</th>
    <th>Preço (R$)</th>
</tr>

<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["codigo"] . "</td>";
    echo "<td>" . $row["nome"] . "</td>";
    echo "<td>" . number_format($row["preco"], 2, ',', '.') . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='3'>Nenhum produto encontrado</td></tr>";
}
?>

</table>

</body>
</html>

<?php
$conn->close();
?>