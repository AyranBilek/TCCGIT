<?php
session_start();
require_once("config.php");
require_once("functions.php");
 
//Pega o nome e a sala que o usuário soliciou entrar
$nome = isset($_POST["txtNome"])?strip_tags($_POST["txtNome"]):"";
$sala = isset($_POST["slSala"])?(int)$_POST["slSala"]:1;
 
//Se o nome não estiver em branco, executa uma rotina de limpeza delete_olde_entries() e inicia o chat.
if(!empty($nome)){
    delete_old_entries();
    start_chat();
}
 
 
?>
<html>
<meta charset="utf-8">
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
<title>Chat</title>
</head>
<body> 
    <div class="formulario2">
<h1>SeeD talk</h1>


<div class="nuvem"><p>Bem Vindo ao Chat Público de SeeD talk aqui você não Precisa ser Cadastradopara se conectar e conhecer pessoas novas , Basta apenas Digitar um nome e escolher uma sala publica de bate-papo , mas se preferir se <a href="../cadastro.php">CADASTRAR AGORA!</a></p></div>

</div>
  
  <div class="formulario"><h2>Chat Público</h2> 
 
<form action="index.php" method="post">
           <input type="text" name="txtNome" id="txtNome" placeholder="Digite um Nome" autocomplete="off" required="" /></p>

   <div class="salas"><h2>Salas</h2></p>
    <?php
    //Lista todas as salas cadastradas no banco de dados
    $tbSala = $conn->prepare("select * from salas");
    $tbSala->execute();
    while($linha=$tbSala->fetch(PDO::FETCH_ASSOC)){
        echo "<button class='botao' name='slSala' id='btnEntrar' value='$linha[id_sala]'>$linha[nm_sala]</br></button>";
    }
    ?></div>
</form>

</div>

</body>
</html>