<html>
	<head>
		<meta charset="UTF-8">
		<title>Cadastrar Agenda</title>

		<?php include_once '../controller/AgendaCtr.class.php';?>
		<?php include_once '../model/vd/AgendaVd.class.php'; ?>

		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="js/cadastro.js"></script>

		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/cadastro.css">
	</head>

	<body>
		<div id="form-wraper">
			<form action="cadastrarAgenda.php" method="POST">
				<h1>Cadastrar Agenda </h1>
				<div class="form-group">
					<label>Dia:</label>
					<input type="text" class="dia" id="dia" name="dia" placeholder="Ex: 20/05/2014"/>				
				</div>

				<div class="form-group">
					<label>Hora:</label>
					<input type="text" class="hora" id="hora" name="hora" placeholder="Ex: 14:30:00"/>				
				</div>
				
				<input type="submit" class="button" name="cadastrar" value="Cadastrar"/>
			</form>		
		</div>
	</body>	
</html>

<?php
if(isset($_POST['cadastrar'])){
	try{
		AgendaVd::validar();

		$ctr = new AgendaCtr();

		$ctr->salvar();

	}catch(Exception $ex){
?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
<?php
	}
}
?>