<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/paciente.css" type="text/css">
	<?php include_once '../controller/PacienteCtr.class.php'; ?>
</head>
<body>
	<header>
		<form action="cadastrarPaciente.php" method="post">
			<input type="submit" name="adicionar" class="form-component button button-add" value="Cadastrar Paciente"/>			
		</form>		
	</header>		
	
	<div id="table">						
		<ul class="table-row">
			<li class='form-component table-column' for='nome'>Nome</li> 
			<li class='form-component table-column' for='nome'>Apelido</li> 
			<li class='form-component table-column' for='nome'>Telefone/Celular</li>				
		</ul>			

		<?php 
			try{

				$ctr = new PacienteCtr();

				$pacientes = $ctr->getLista();

				if($pacientes != NULL){

					foreach($pacientes as $paciente){ 
					?>
						<ul class="table-row">
							<li class='form-component table-column'><?php echo $paciente['nome']; ?></li> 
							<li class='form-component table-column'><?php echo $paciente['endereco']; ?></li> 
							<li class='form-component table-column'><?php echo $paciente['email']; ?></li> 
							<li class='form-component table-column'><?php echo $paciente['dt_nascimento']; ?></li> 

							<!-- <li class='form-component table-column'><span class="telefone"><?php echo $paciente['telefone']; ?> </span>/<span class="celular"><?php echo $paciente['celular']; ?></span></li>							 -->

							<li class='form-component table-column list-button update'><a href= <?php echo strtr($paciente['nome'], array(" " => "%20"));?> >Alterar</a></li>
							<li class='form-component table-column list-button delete'><a href= <?php echo strtr($paciente['nome'], array(" " => "%20"));?> >Excluir</a></li>				
						</ul>			
		
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
<script type="text/javascript" src="js/listar.js"></script>
</html>