<?php
header('Content-Type: application/json');

// Verificar se os dados foram enviados via POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar com o banco
    $conn = new mysqli ("localhost","root","","estoque");

    if($conn->connect_error) {
        die(json_encode(["erro" => "Erro ao conectar"]));
    }

    //Receber e limpar os dados
    $nome = $conn -> real_escape_string($_POST['nome']);
    $quantidade = (int) $_POST['quantidade'];
    $preco = (float) $_POST['preco'];

    //Inserir no banco
    $sql = "INSERT INTO produtos (nome, quantidade, preco) VALUES('$nome', $quantidade, $preco)";
    if($conn -> query($sql)){
        echo json_encode(["sucesso" =>true,"mensagem" =>"Produto inserido com sucesso!"]);
    } else {
        echo json_encode(["erro" => "Erro ao inserir produto."]);
    }
    $conn->close();
} else {
    echo json_encode(["erro" => "Requisição inválida."]);
}