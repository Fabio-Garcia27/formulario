<?php

//Chamar configuração de conexão
require_once 'config.php';

//Gravar hora correta
date_default_timezone_set('America/Sao_Paulo');

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$data_atual = date('d/m/Y');  // 11/12/2025 y = 25 Y = 2025
$hora_atual = date('H:i:s');  // 15:28

//Preparar comando e dados para tabela
$smtp = $conn->prepare("INSERT INTO mensagens (nome, email, mensagem, data, hora) VALUES (?,?,?,?,?)");
$smtp->bind_param("sssss", $nome, $email, $mensagem, $data_atual, $hora_atual);

//Se executar corretamente
if ($smtp->execute()) {
    echo "Mensagem enviada com sucesso !";
}else {
    echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$conn->close();

?>