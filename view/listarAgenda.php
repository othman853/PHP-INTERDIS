<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">

	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/cadastro.js"></script>
	
	<?php include_once '../controller/AgendaCtr.class.php'; ?>
	<?php include_once 'ViewUtils.class.php'; ?>

	<?php
	session_start();

	if (!isset($_SESSION['usuario'])) {				
		header("Location: requisitarLogin.html");
	}		

	if($_SESSION['nivel_usuario'] != 0  && 
		$_SESSION['nivel_usuario'] != 1 && 
		$_SESSION['nivel_usuario'] != 2)
	{									
		
		header("Location: bloquearAcesso.html");
	}				
	?>
	<title>Agenda</title>
</head>

<body>

	<?php 			
	try{
		$ctr = new AgendaCtr();

		$agendas = $ctr->getListaDisponiveis();				

		if($agendas != NULL){					

			foreach($agendas as $agenda){ 
				?>	
				<article id="form-wraper">
					<div class="form-group">
						<label>Dia:</label>
						<span class="input dia"><?php echo ViewUtils::converterDataParaPadraoBrasileiro($agenda['dia']);?></span>
					</div>
					
					<div class="form-group">
						<label>Hora:</label>
						<span class="input"><?php echo $agenda['hora'];?></span>
					</div>
					
					<div class="form-group">
						<label>Médico:</label>
						<span class="input"><?php echo $agenda['nome_medico'];?></span>
					</div>

					<?php
					if($agenda['estado'] == 0){
						?>	
						<span class='form-component table-column list-button update'>
							<a href= <?php echo "novaConsulta.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'];?> >Marcar</a>
						</span>					
				</article>		
					<?php 
					}
			} 
		}else{					
			?> <div class='message success' > Não há agendas.</div><?php
		}
	}catch(Exception $ex){				
		?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
	<?php
	}
	?>	
</body>	
</html>