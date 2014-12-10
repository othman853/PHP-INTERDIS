<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">
	<?php include_once '../controller/AgendaCtr.class.php'; ?>
</head>
<body>
	<header>
		<form action="cadastrarPaciente.php" method="post">
			<input type="submit" name="adicionar" class="form-component button button-add" value="Cadastrar Paciente"/>			
		</form>		
		<!-- <span><a href="menu.php" class="form-component button button-add">Menu</a></span> -->
	</header>			
	
	<div id="table">								
		<?php 			
			try{
				$ctr = new AgendaCtr();

				$agendas = $ctr->getLista();

				echo "Try";

				if($agendas != NULL){

					echo "Not null";

					foreach($agendas as $agenda){ 
					?>	
					<article id="form-wraper">
						<div class="form-group">
							<label>Médico:</label>						
							<span class="input"><?php echo $agenda['nome_medico'];?></span>
						</div>


						<div class="form-group">
							<label>Dia:</label>
							<span class="input"><?php echo $agenda['dia'];?></span>
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
								<span class='form-component table-column list-button update'>
									<a href= <?php echo "marcarConsulta.php?id=".$agenda['crm'];?> >Marcar</a>
								</span>
						<?php
							}
						?>
<!-- 
						<span class='form-component table-column list-button delete'>
							<a href= <?php echo "excluirPaciente.php?id=".$paciente['cod_paciente'];?> >Excluir</a>
						</span>	 -->			

					</article>		
		  <?php 
					} 
				}else{
					echo "OK";
					?> <div class='message success' > Não há agendas.</div><?php
				}
			}catch(Exception $ex){
				echo "EXCEPTION";
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