<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$data_atual = date('d/m/Y');  // 11/12/2025 y = 25 Y = 2025
$hora_atual = date('H:i:s');  // 15:28

//Configurações de credênciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'aula_formulario';

//Conexão banco de dados
$conn = new mysqli($server, $usuario, $senha, $banco);

//Verificar conexão
if ($conn->connect_error) {
    die("Falha ao se comunicar com o banco de dados:" .$conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO mensagens (nome, email, mensagem, data, hora) VALUES (?,?,?,?,?)");
$smtp->bind_param("sssss", $nome, $email, $mensagem, $data_atual, $hora_atual);

if ($smtp->execute()) {
    echo "Mensagem enviada com sucesso !";
}else {
    echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$conn->close();

?>