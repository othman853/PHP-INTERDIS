<html> 
	<head>
		<title>Trabalho Interdisciplinar</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="view/css/main.css" type="text/css">
		<link rel="stylesheet" href="view/css/cadastro.css" type="text/css">		
		<link rel="stylesheet" href="view/css/index.css" type="text/css">		

		<?php include_once 'controller/LoginCtr.class.php'; ?>		

		<title>Bem vindo</title>
	</head>
	<body>
		<div id="login-wrapper">	
			<form id="login-form" method="post" action="index.php">
				<h1 class="title">Login</h1>


				<div class="form-group">
					<label class="form-component" for="usuario">Usuário:</label>	
					<input type="text" name="login" id="login" class="form-component input">
				</div>

				<div class="form-group">
					<label class="form-component" for="senha">Senha:</label>
					<input type="password" name="senha" id="senha" class="form-component input">
				</div>
				
				<input type="submit" class="form-component button" name="entrar" value="Entrar" />

			</form>
		</div>
	</body>

	<?php
	if(isset($_POST['entrar'])){
		try{			

		$ctr = new LoginCtr();
			
			$ctr->validarCredenciais();							
			
		}catch(Exception $ex){
		?> 
			<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
		<?php
		}
	}
	?>	
</html>