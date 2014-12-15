<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">
	<?php include_once '../controller/ConsultaCtr.class.php'; ?>

	<title>Consultas</title>

	<?php
		session_start();
		if(!isset($_SESSION['usuario'])){
			session_destroy();
			header("Location: requisitarLogin.html");
		}

		if($_SESSION['nivel_usuario'] != 2 && $_SESSION['nivel_usuario'] != 3){
			session_destroy();
			header("Location: bloquearAcesso.html");
		}
	?>
</head>
<body>
	<header>
		<form action="novaConsulta.php" method="post">
			<input type="submit" name="adicionar" class="form-component button button-add" value="Nova Consulta"/>
			<span class="button to-right"><a href="menu.php"> Menu </a></span>			
			<span class="button to-right"><a href="gerarPdf.php"> Gerar PDF </a></span>
		</form>				
	</header>			
	
	<div id="table">								
		<?php 			
			try{
				$ctr = new ConsultaCtr();

				$consultas = $ctr->getLista();				

				if($consultas != NULL){					

					foreach($consultas as $consulta){ 
					?>	
						<article id="form-wraper">
							<div class="form-group">
								<label>Médico:</label>
								<span class="input"><?php echo $consulta['nome_medico'];?></span>
							</div>
							
							<div class="form-group">
								<label>Paciente:</label>
								<span class="input"><?php echo $consulta['nome_paciente'];?></span>
							</div>
							
							<div class="form-group">
								<label>Dia:</label>
								<span class="input"><?php echo $consulta['data_consulta'];?></span>
							</div>

							<div class="form-group">
								<label>Hora:</label>
								<span class="input"><?php echo $consulta['hora_consulta'];?></span>
							</div>

							<div class="form-group">
								<label>Situacao:</label>
								<span class="input"><?php echo $consulta['situacao'];?></span>
							</div>
						</article>		
		  	<?php 
					} 
				}else{					
					?> <div class='message success' > Não há consultas.</div><?php
				}
			}catch(Exception $ex){				
		   ?>
				<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
		<?php
			}

		?>
			

	</div>	
</body>	
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/cadastro.js"></script>
</html>