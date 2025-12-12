<?php

//Chamar configuração de conexão
require_once 'config.php';

$mensagemErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senhadigitada = $_POST['senha'];
    $senhaSecreta = "123";

    //Digitou a senha certa
    if ($senhadigitada === $senhaSecreta) {
        $sql = "Select * from mensagens";
        $result = $conn->query($sql);
    }else {
        $mensagemErro = "<h1>Senha Incorreta!</h1>";
    } 
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form method="post">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua Senha" required>
        <button type="submit">Enviar</button>

        <?php if (isset($result) && $result->num_rows >0) : ?>
        <?php endif; ?>    
            <h2>Mensagens</h2>
            <ul>
                <?php while($row = $result-> fetch_assoc()) : ?>
                    <li>
                        <strong>Nome: </strong> <?php echo $row["nome"]; ?> <br>
                        <strong>E-mail: </strong> <?php echo $row["email"]; ?> <br>
                        <strong>Mensagem: </strong> <?php echo $row["mensagem"]; ?> <br>  
                        <strong>Data e Hora: </strong> <?php echo $row["data"]. " às ".$row["data"]; ?><br>
                    </li> 
                <?php endwhile; ?>                               
            </ul>

        <!-- Mensagem aparece exatamente aqui -->
        <?php if (!empty($mensagemErro)) : ?>
            <p style="color:red; margin-top:10px;">
                <?= $mensagemErro ?>
            </p>
        <?php endif; ?>

    </form>
</body>

</html>