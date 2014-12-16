<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/crud.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">

	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/cadastro.js"></script>

	<?php include_once '../controller/MedicoCtr.class.php'; ?>

	<?php
	session_start();

	if(!isset($_SESSION['usuario'])){
		header("Location: requisitarLogin.html");
	}

	if($_SESSION['nivel_usuario'] != 0 &&
		$_SESSION['nivel_usuario'] != 2){

		header("Location: bloquearAcesso.html");
	}
?>

<title>Lista de Médicos</title>
</head>
<body>
	<header>
		<form action="cadastrarMedico.php" method="post">
			<input type="submit" name="adicionar" class="form-component button button-add" value="Cadastrar Médico"/>			
			<span class="button to-right"><a href="menu.php"> Menu </a></span>
		</form>		

	</header>		

	<?php 
	try{
		$ctr = new MedicoCtr();
		$medicos = $ctr->getLista();

		if($medicos != NULL){

			foreach($medicos as $medico){ 
				?>
				<article id="form-wraper">

					<div class="form-group">
						<label>CRM:</label>
						<span class="input"> <?php echo $medico['crm'];?> </span>				
					</div>

					<div class="form-group">
						<label>Nome:</label>
						<span class="input"> <?php echo $medico['nome'];?> </span>				
					</div>

					<div class="form-group">
						<label>Email:</label>
						<span class="input"> <?php echo $medico['email'];?> </span>				
					</div>

					<div class="form-group">
						<label>Celular:</label>
						<span class="input"> <?php echo $medico['celular'];?> </span>				
					</div>

					<div class="form-group">
						<label>Telefone:</label>
						<span class="input telefone"> <?php echo $medico['telefone'];?> </span>				
					</div>	

					<span class='form-component table-column list-button update'><a href= <?php echo "cadastrarMedico.php?id=" . $medico['crm'];?> >Alterar</a></span>
					<span class='form-component table-column list-button delete'><a href= <?php echo "excluirMedico.php?id=" . $medico['crm'];?> >Excluir</a></span>				
				</article>

				<?php 
			} 
		}else{
			?> <div class='message success' > Não há médicos na lista.</div><?php
		}
	}catch(Exception $ex){
		?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
		<?php
	}
	?>
	
</body>	
</html>