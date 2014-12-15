<html>
	<head>
		<meta charset="UTF-8">
		<title>Nova Consulta</title>

		<?php include_once '../controller/ConsultaCtr.class.php';?>
		<?php include_once '../model/vd/ConsultaVd.class.php'; ?>

		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="js/cadastro.js"></script>

		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/cadastro.css">

		<?php
			session_start();
			if(!isset($_SESSION['usuario'])){
				header("Location: requisitarLogin.html");
			}

			if($_SESSION['nivel_usuario'] != 2){
				header("Location: bloquearAcesso.html");
			}
		?>

	</head>

	<body>
		<div id="form-wraper">
			<form action="cadastrarAgenda.php" method="POST">
				<h1>Nova Consulta </h1>
				<div class="form-group">
					<label>Dia:</label>
					<input type="text" class="dia" id="dia" name="dia" placeholder="Ex: 20/05/2014"/>				
				</div>

				<div class="form-group">
					<label>Hora:</label>
					<input type="text" class="hora" id="hora" name="hora" placeholder="Ex: 14:30:00"/>				
				</div>

				<!-- Se a consulta for marcada por Atendente:--> 
				<!-- Selecionar Paciente -->

				<!-- Selecionar Médico -->

				
				<input type="submit" class="button" name="cadastrar" value="Marcar"/>
			</form>		
		</div>
	</body>	
</html>

<?php
if(isset($_POST['cadastrar'])){
	try{
		ConsultaVd::validar();

		$ctr = new ConsultaCtr();

		$ctr->salvar();

	}catch(Exception $ex){
?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
<?php
	}
}
?>