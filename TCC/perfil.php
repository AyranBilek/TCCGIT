<?php
	session_start();
	include_once "defines.php";
	require_once('classes/BD.class.php');
	BD::conn();

	if(!isset($_SESSION['email_logado'], $_SESSION['id_user'])){
		header("Location: index.php");
	}

	$pegaUser = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE `email` = ?");


	$pegaUser->execute(array($_SESSION['email_logado']));
	$dadosUser = $pegaUser->fetch();
    //BOTAO DE SAIR
	if(isset($_GET['acao']) && $_GET['acao'] == 'sair'){
		unset($_SESSION['email_logado']);
		unset($_SESSION['id_user']);
		session_destroy();
		header("Location: index.html");
	}
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
	<head>
<meta charset=UTF-8>

        <!--link dos icones "fontawesome"-->
		<link href="css/styleperfil.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="https://kit.fontawesome.com/d7779d0d8d.js" crossorigin="anonymous"></script>		
		<title>TCC</title>
</head>

		<div class="menu">
  <ul class="menu-list">
    <li><a href="chat.php"><i class="fas fa-leaf"></i> Home</a></li>
    <li>
      <a href="#" onclick="Mudarestado('minhaDiv')" ><i class="fas fa-users"></i> Usuarios</a></li>
    <li><a href="perfil.php"><i class="fas fa-user-alt"></i> Perfil</a></li>
    <li><a href="#"><i class="fas fa-cog"></i> Configurações</a>
     <ul class="sub-menu">
        <li><a href="#"><i class="fas fa-user-cog"></i> Conta</a></li>
      </ul>
    </li>
    <li><a href="?acao=sair"><i class="fas fa-user-alt-slash"></i> Sair</a></li>
  </ul>

<div class="search" align="right">
  <form action=" " method="post" >
  <input type="search" id="busca" name="q" placeholder="Pesquisar...">
  <button type="submit"><i class="fas fa-search"></i></button>
</form>
</div>

</div>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery_play.js"></script>
		<script type="text/javascript">
			$.noConflict();
		</script>
		
	

	<body>


		<span class="user_online" id="<?php echo $dadosUser['id'];?>"></span>
		<!--DA UM ALERTA COM O NOME DO USUARIO-->
		<!--<script language="javascript" type="text/javascript">alert('Bem vindo, <?php echo $dadosUser['nome'];?>')
	</script>-->
		
	<script language="javascript" type="text/javascript">function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}</script>
	<div id="minhaDiv" style="display:none">
		<aside id="users_online">
			<ul>
			
			<?php
				$pegaUsuarios = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE `id` != ?");
				$pegaUsuarios->execute(array($_SESSION['id_user']));
				while($row = $pegaUsuarios->fetch()){
					$foto = ($row['foto'] == '') ? 'default.jpg' : $row['foto'];
					$blocks = explode(',', $row['blocks']);
					$agora = date('Y-m-d H:i:s');
					if(!in_array($_SESSION['id_user'], $blocks)){
						$status = 'on';
						if($agora >= $row['limite']){
							$status = 'off';
						}
					}
				}
			?>
				<li id="<?php echo $row['id'];?>">
					<div class="imgSmall"><img src="fotos/<?php echo $foto;?>" border="0" />
					</div>
					<a href="#" id="<?php echo $_SESSION['id_user'].':'.$row['id'];?>" class="comecar"><?php echo utf8_encode($row['nome']);?></a>
					<span id="<?php echo $row['id'];?>" class="status <?php echo $status;?>">
						
					</span>
				</li>
		
			 
			</ul>
		</aside>
		<aside id="chats">
			
		</aside>
	</div>

			<script type="text/javascript" src="js/functions.js"></script>
	

        <!--nome do usuario e foto de perfil-->
        
        
		<li id="<?php echo $row['id'];?>">
        
    <div class="capa"><img src="fotos/capadefault.jpg" /></div>
		<div class="foto" id="<?php echo $_SESSION['id_user'].':'.$row['id'];?>"><img src="fotos/<?php echo $foto;?>" /><h3><?php echo $dadosUser['nome'];?></h3></div>

</li>

        <div class="menuPerfil">
		<ul class="listaPerfil">
    <li><a href="#"><i class="fas fa-camera"></i> Foto de Perfil</a></li>
      <li><a href="#"><i class="fas fa-camera"></i> Foto de Capa</a></li>
    <li><a href="#"><i class="fas fa-user-edit"></i> Configurações de Perfil</a>
    </li>
  </ul>
</div>


</body>
</html>