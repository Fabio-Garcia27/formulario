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
        <div class="mensagens">
        <?php if (isset($result) && $result->num_rows >0) : ?>
            <h2 style="text-aling:center">Mensagens</h2>
            <ul>
                <?php while($row = $result-> fetch_assoc()) : ?>
                    <li>
                        <strong>Nome: </strong> <?php echo $row["nome"]; ?> <br>
                        <strong>E-mail: </strong> <?php echo $row["email"]; ?> <br>
                        <strong>Mensagem: </strong> <?php echo $row["mensagem"]; ?> <br>  
                        <strong>Data e Hora: </strong> <?php echo $row["data"]. " às ".$row["hora"]; ?><br><br>
                    </li> 
                <?php endwhile; ?>                               
            </ul>
        <?php else : ?>
            <p>Nenhuma mensagem.</p>   
        <?php endif; ?>             
        <!-- Mensagem aparece exatamente aqui -->
        <?php if (!empty($mensagemErro)) : ?>
            <p style="color:red; margin-top:10px;">
                <?= $mensagemErro ?>
            </p>
        <?php endif; ?>
        </div>            
    </form>
</body>

</html>