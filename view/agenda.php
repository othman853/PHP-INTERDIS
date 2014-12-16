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

	if($_SESSION['nivel_usuario'] != 0 && 
		$_SESSION['nivel_usuario'] != 3){									
		
		header("Location: bloquearAcesso.html");
}				
?>

<title>Agenda</title>
</head>
<body>
	<header>
		<form action="cadastrarAgenda.php" method="post">
			<input type="submit" name="adicionar" class="form-component button button-add" value="Cadastrar Agenda"/>
			
			<span class="button to-right"><a href="menu.php"> Menu </a></span>			
			<span class="button to-right"><a href="gerarXml.php"> Gerar XML </a></span>			
			
		</form>				
	</header>			
	
	
	<?php 			
	try{
		$ctr = new AgendaCtr();

		$agendas = $ctr->getLista();				

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
						<label>Estado:</label>
						<span class="input"><?php echo $agenda['descricao_estado'];?></span>
					</div>
					<?php
					if($agenda['estado'] == 0){
						?>							

						<span class='form-component table-column list-button delete'>
							<a href= <?php echo "alterarAgenda.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'] . "&c=3";?> >Cancelar</a>
						</span>
						<?php
					}else if ($agenda['estado'] == 1){								
						?>
						<span class='form-component table-column list-button delete'>
							<a href= <?php echo "alterarAgenda.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'] . "&c=3";?> >Cancelar</a>
						</span>
						<?php

					}else if ($agenda['estado'] == 2){								
						?>
						<span class='form-component table-column list-button delete'>
							<a href= <?php echo "alterarAgenda.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'] . "&c=100";?> >Excluir</a>									
						</span>
						<?php

					}else if ($agenda['estado'] == 3){								
						?>
						<span class='form-component table-column list-button update'>
							<a href= <?php echo "alterarAgenda.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'] . "&c=0";?> >Reabrir</a>									
						</span>

						<span class='form-component table-column list-button delete'>
							<a href= <?php echo "alterarAgenda.php?crm=".$agenda['crm'] . "&hora=" . $agenda['hora'] . "&dia=" . $agenda['dia'] . "&c=100";?> >Excluir</a>									
						</span>
						<?php
					}
					?>
				</article>		
				<?php 
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