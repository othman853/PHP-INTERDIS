<html>
	<head>
		<meta charset="UTF-8">
		<title>Nova Consulta</title>

		<?php include_once '../controller/ConsultaCtr.class.php';?>
		<?php include_once '../model/vd/ConsultaVd.class.php'; ?>

		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>		
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>

		<script type="text/javascript" src="js/cadastro.js"></script>
		<script type="text/javascript" src="js/consulta.js"></script>

		<link rel="stylesheet" href="css/jquery-ui.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/crud.css" type="text/css">
		<link rel="stylesheet" href="css/cadastro.css">	
		<link rel="stylesheet" href="css/consulta.css">	

		<?php include_once 'ViewUtils.class.php'; ?>

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
		<div id="dialog">								
		</div>

		<div id="form-wraper">
			<form action="novaConsulta.php" method="POST">
				<h1>Nova Consulta </h1>

				<div class="form-group">
					<label>Dia:</label>
					<input type="text" class="dia" id="dia" name="dia" value=<?php if(isset($_GET['dia'])) echo ViewUtils::converterDataParaPadraoBrasileiro($_GET['dia']); else echo "";?> readonly />
				</div>

				<div class="form-group">
					<label>Hora:</label>
					<input type="text" class="hora" id="hora" name="hora" value=<?php if(isset($_GET['hora'])) echo $_GET['hora']; else echo ""; ?> readonly />					
				</div>

				<!-- Se a consulta for marcada por Paciente:--> 
				<?php
					if($_SESSION['nivel_usuario'] == 1){
					?>
						<input type="hidden" id="cod-paciente" name="cod_paciente" value=<?php echo "'" . $_SESSION['identificacao_usuario']  . "'"; ?> />
				<?php
					}
				?>
								
				<?php
					if($_SESSION['nivel_usuario'] == 2){
					?>
						<div class="form-group">				
							<label class="choose-button list-button update" id="btn-paciente">Selecionar Paciente</label>
							<input type="text" id="cod-paciente" name="cod_paciente" readonly value = "Clique no botão ao lado para escolher o paciente ">
						</div>
				<?php
					}
				?>

				<div class="form-group">
					<label>Médico:</label>					
					<input type="text" class="crm" id="crm" name="crm" value=<?php if(isset($_GET['crm'])) echo $_GET['crm']; else echo "";?> readonly/>					
				</div>
				
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