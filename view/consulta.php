<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">

	<?php include_once '../controller/ConsultaCtr.class.php'; ?>
	<?php include_once 'ViewUtils.class.php'; ?>

	<title>Consultas</title>

	<?php		
		session_start();

		if(!isset($_SESSION['usuario'])){			
			header("Location: requisitarLogin.html");
		}

		if($_SESSION['nivel_usuario'] != 0 && 
		   $_SESSION['nivel_usuario'] != 1 && 
		   $_SESSION['nivel_usuario'] != 2 && 
		   $_SESSION['nivel_usuario'] != 3){			
		   	
			header("Location: bloquearAcesso.html");
		}
	?>
</head>
<body>
	<header>
		<form action="listarAgenda.php" method="post">
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
								<span class="dia input"><?php echo ViewUtils::converterDataParaPadraoBrasileiro($consulta['data_consulta']);?></span>
							</div>

							<div class="form-group">
								<label>Hora:</label>
								<span class="input"><?php echo $consulta['hora_consulta'];?></span>
							</div>

							<div class="form-group">
								<label>Situação:</label>
								<span class="input"><?php echo $consulta['situacao'];?></span>
							</div>

							<?php
							if($_SESSION['nivel_usuario'] == 2 && $consulta['situacao'] != 'CANCELADA'){
							?>								
								<span class="form-component table-column list-button delete"><a href=<?php echo "cancelarConsulta.php?id=" . $consulta['cod_consulta'];?> > Cancelar</a></span>								
							<?php
							}	
							?>
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