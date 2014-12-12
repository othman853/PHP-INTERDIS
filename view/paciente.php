<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">
	<?php include_once '../controller/PacienteCtr.class.php'; ?>
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

				$ctr = new PacienteCtr();

				$pacientes = $ctr->getLista();

				if($pacientes != NULL){

					foreach($pacientes as $paciente){ 
					?>	
					<article id="form-wraper">
						<div class="form-group">
							<label>Nome:</label>						
							<span class="input"><?php echo $paciente['nome'];?></span>
						</div>


						<div class="form-group">
							<label>Email:</label>
							<span class="input"><?php echo $paciente['email'];?></span>
						</div>
						
						<div class="form-group">
							<label>Telefone:</label>
							<span id="telefone" class="input telefone"><?php echo $paciente['telefone'];?></span>
						</div>
						
						<div class="form-group">
							<label>Endereço:</label>
							<span class="input"><?php echo $paciente['endereco'];?></span>
						</div>

						<span class='form-component table-column list-button update'><a href= <?php echo "cadastrarPaciente.php?id=".$paciente['cod_paciente'];?> >Alterar</a></span>
						<span class='form-component table-column list-button delete'><a href= <?php echo "excluirPaciente.php?id=".$paciente['cod_paciente'];?> >Excluir</a></span>				
					</article>
						
		
		  <?php 
					} 
				}else{
					?> <div class='message success' > Não há pacientes na lista.</div><?php
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