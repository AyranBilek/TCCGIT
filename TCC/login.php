
<?php
	session_start();
	include_once "defines.php";
	require_once('classes/BD.class.php');
	BD::conn();
?>
<!--CODIGO PHP PARA VERIFICAR SE O EMAIL E SENHA EXISTE NO BANCO-->
			<?php
				if(isset($_POST['acao']) && $_POST['acao'] == 'logar'){
					$email = strip_tags(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));

					$senha = strip_tags(trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));
				
					//SE O EMAIL ESTIVER VAZIO ELE MOSTRA A MENSAGEM ABAIXO
					if($email == '' || $senha == ''){
						echo "<script language='javascript' type'text/javascript> alert('Digite seu Email e/ou Senha!');window.location.href='index.html';</script>";


					}else{
						//ELE PROCURA NO BANCO PELO USUARIO
						$pegaUser = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE `email`  = ? ");
						$pegaUser->execute(array($email));

						$pegaUser = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE `senha`  = ? ");
						$pegaUser->execute(array($senha));

						//SE O USUARIO NAO EXISTIR OU A SENHA ESTIVER INCORRETA ELE MOSTRA A MENSAGEM
						if($pegaUser->rowCount() == 0){
							echo "<script language='javascript' type'text/javascript> alert('E-mail ou senha incorretos!');window.location.href='index.html';</script>";
						}else{
							$agora = date('Y-m-d H:i:s');
							$limite = date('Y-m-d H:i:s', strtotime('+2 min'));
							$update = BD::conn()->prepare("UPDATE `usuarios` SET `horario` = ?, `limite` = ? WHERE `email` = ?");
							if( $update->execute(array($agora, $limite, $email)) ){
								while($row = $pegaUser->fetchObject()){
									//SE O EMAIL SE EXISTIR LE É LEVADO PARA A "HOME" DO SITE "CHAT.PHP"
									$_SESSION['email_logado'] = $email;
									$_SESSION['id_user'] = $row->id;
									header("Location: chat.php");
								}
							}
						}
					}
				}
			?>