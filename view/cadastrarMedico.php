<html>
	<head>
		<meta charset="UTF-8">
		<title>Cadastrar Medico</title>

		<?php include_once '../controller/MedicoCtr.class.php';?>
		<?php include_once '../model/vd/MedicoVd.class.php'; ?>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/cadastro.css">

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

	</head>
	<body>
		<div id="form-wraper">
			<form action="cadastrarMedico.php" method="POST">
				<h1>Cadastrar Médico </h1>
				<div class="form-group">
					<label>CRM:</label>
					<input type="text" class="crm" id="crm" name="crm" placeholder="Ex: 2945"/>				
				</div>

				<div class="form-group">
					<label>Nome:</label>
					<input type="text" id="nome" name="nome" placeholder="Ex: Maria Silva"/>				
				</div>

				<div class="form-group">
					<label>Email:</label>
					<input type="text" id="email" name="email" placeholder="Ex: maria.silva@gmail.com"/>				
				</div>

				<div class="form-group">
					<label>Celular:</label>
					<input type="text" class="celular" id="celular" name="celular" placeholder="(99)9999-9999"/>				
				</div>

				<div class="form-group">
					<label>Telefone:</label>
					<input type="text" class="telefone" id="telefone" name="telefone" placeholder="Ex: (51)9999-9999"/>				
				</div>			

				<input type="submit" class="button" name="cadastrar" value="Cadastrar"/>

			</form>		
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/cadastro.js"></script>
</html>

<?php
if(isset($_POST['cadastrar'])){
	try{
		MedicoVd::validar();
		$ctr = new MedicoCtr();
		$ctr->salvar();
	}catch(Exception $ex){
?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
<?php
	}
}
?>