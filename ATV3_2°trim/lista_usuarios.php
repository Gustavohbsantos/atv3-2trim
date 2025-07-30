<?php
// Conecte-se ao seu banco de dados
$servername = "localhost"; // ou o endereço do seu servidor
$username = "seu_usuario"; // Substitua pelo seu usuário do banco de dados
$password = "sua_senha"; // Substitua pela sua senha do banco de dados
$dbname = "seu_banco_de_dados"; // Substitua pelo nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recupera os dados do formulário
$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$funcao = $_POST['funcao'];

// Prepara a declaração SQL para evitar SQL injection
$sql = "INSERT INTO usuarios (nome, matricula, funcao) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $matricula, $funcao);

// Executa a declaração e verifica o resultado
if ($stmt->execute()) {
    echo json_encode(array("sucesso" => true, "mensagem" => "Usuário cadastrado com sucesso!"));
} else {
    echo json_encode(array("sucesso" => false, "erro" => "Erro ao cadastrar usuário: " . $conn->error));
}

$stmt->close();
$conn->close();
?>
