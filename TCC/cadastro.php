<html >
<head>
	<link href="css/stylecadastro.css" rel="stylesheet" type="text/css" />
	

<meta charset="utf-8" />
<title>Cadastro de usuário</title>
</head>
 
<body>
	<div class="formulario2"><h2>SeeD talk</h2><p>
			<br>Bem vindo ao SeeD talk um chat para conectar pessoas e desenvolver novas <br>Amizades , Cadastre-se
			agora !<a href="index.html">Logar</a></p>

		</div>
		<div class="formulario"><h1>Cadastro</h1>
			

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
	<label>
<b>Nome<p/>
<input type="text" name="nome" autocomplete="off" placeholder="Digite seu Nome..." required="" /><p/>
Email<br />
<input type="text" name="email" autocomplete="off" placeholder="Exemploseedtalk@gmail.com..." required="" /><p/>
Senha<br />
<input type="password" name="senha" autocomplete="off" placeholder="Digite sua Senha..." required="" /><p/>
Foto<br/>

<input type="file" size="60" name="foto" /></p><b/>
</label>

<input type="hidden" name="acao" value="logar" />
<input type="submit" name="cadastrar" value="Cadastrar" class="botao right" />
<a href="chat publico/chatpublico.php"><button class="botao right">Chat Publico</button></a>

</form>
</div>
</body>
</html>


<?php
    session_start();
    include_once("conexao.php");

    if (isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $foto = $_FILES['foto']['name']; //O nome do ficheiro
    $arq_size = $_FILES['foto']['size']; //O tamanho do ficheiro
    $arq_tmp = $_FILES['foto']['tmp_name']; //O nome temporário do arquivo
    
    $result_usuario = "INSERT INTO usuarios (nome, email, senha, foto , dt_cadastro ) VALUES ('$nome','$email', '$senha', '$foto', NOW())";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    move_uploaded_file($arq_tmp, "fotos/".$foto);


    if(mysqli_affected_rows($conn) != 0){
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/TCC/cadastro.php'>
                    <script type='text/javascript'>'
                        alert('Usuario cadastrado com Sucesso.');
                    </script>
                ";    
            }else{
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/TCC/cadastro.php'>
                    <script type='text/javascript'>
                        alert('O Usuario não foi cadastrado com Sucesso.');
                    </script>
                ";    
            }
        }


?>

<!--

// Conexão com o banco de dados
session_start();
	include_once "defines.php";
	require_once('classes/BD.class.php');
     BD::conn();
 
// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['cadastrar'])) {
	
	// Recupera os dados dos campos
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$foto = $_FILES["foto"];
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
		 //Largura máxima em pixels
		$largura = 150;
		// Altura máxima em pixels
		$altura = 180;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000;
 
		$error = array();
 
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
		}
 
		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}
 
		// Se não houver nenhum erro
		if (count($error) == 0) {
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "fotos/" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			// Insere os dados no banco
			$sql("INSERT INTO `usuarios` ('nome', 'email', 'senha' , 'foto' ) VALUES ('', '".$nome."', '".$email."', '".$senha."' ,'".$nome_imagem."', '".NOW()."' )");
		
			// Se os dados forem inseridos com sucesso
			if ($sql){
				echo "Você foi cadastrado com sucesso.";
			}
		}
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
				echo $erro . "<br deu bosta />";
			}
		}
	}
}-->
