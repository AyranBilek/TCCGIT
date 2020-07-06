<?php
session_start();
require_once("config.php");
require_once("functions.php");
 
//Verifica se a sessão existe
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit();
}
 
//Verifica se o usuário já foi excluído do banco
$tbUser = $conn->prepare("select count(*) as total from usuarios where id_usuario=:id");
$tbUser->bindParam(":id",$_SESSION["user"], PDO::PARAM_INT);
$tbUser->execute();
$linha = $tbUser->fetch(PDO::FETCH_ASSOC);
if($linha["total"] < 1){
    session_destroy();
    header("Location: index.php");
    exit(); 
}
 
//Pega o nome do destinatário da mensagem
$to = isset($_POST["slUsers"])?$_POST["slUsers"]:"";
 
//Verifica se o usuário enviou alguma mensagem, caso positivo, ele chama a função interagir passando os dados do respectivo usuário como parâmetro.
 
if(isset($_POST["btnEnviar"]) && isset($_POST["txtMensagem"])){
    interagir($_SESSION["user_name"], $to, $_SESSION["sala"], strip_tags($_POST["txtMensagem"]) );
}

if(isset($_GET['acao']) && $_GET['acao'] == 'sair'){
        session_destroy();
        header("Location: index.php");
    }
?>



<html>
<meta charset="utf-8">
<head>
    <link rel="stylesheet" type="text/css" href="style/stylechat.css">
<title>Chat</title>
</head>
<body>

 
<h1>Seed talk Chat Publico</h1>
 

 
<form action="chat.php" method="post">
<iframe src="interacao.php" width="500px" height="500px" frameborder="0" scrolling="yes"></iframe> 
  
    <?php require_once("chat.php");?> 
 <div class="env">
 <input type="text" name="txtMensagem" cols="60" rows="3" id="txtMensagem" autocomplete="off" placeholder="Digite uma Mensagem..."></input>
    
    <div class="but">
    <input type="submit" name="btnEnviar" id="btnEnviar" value="Enviar" /></div></div>
</form>
<div class="sas"><a href="?acao=sair">Sair da Sala</a> <b><?php echo pega_nome_sala($_SESSION["sala"]);?></b></div>
</body>
</html>