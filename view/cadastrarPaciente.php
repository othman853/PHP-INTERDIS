<html>
	<head>
		<meta charset="UTF-8">
		<title>Cadastrar Paciente</title>

		<?php include_once '../controller/PacienteCtr.class.php';?>
		<?php include_once '../model/vd/PacienteVd.class.php'; ?>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/cadastro.css">
	</head>
	<body>

	<?php
	if(isset($_GET['id'])){
		$ctr = new PacienteCtr();
		$paciente = $ctr->buscar($_GET['id']);		
	}


	function renderizarCampo($campo){
		$placeholder = "";

		switch ($campo) {
			case 'nome':
				$placeholder = "Ex: Maria da Silva";
				break;

			case 'endereco':
				$placeholder = "Ex: Av. Assis Brasil, 300";
				break;

			case 'telefone':
				$placeholder = "Ex: (99)9999-9999";
				break;

			case 'email':
				$placeholder = "Ex: maria.silva@email.com";
				break;

			case 'dt-nascimento':
				$placeholder = "Ex: 09/09/1990";
				$campo = "dt_nascimento";
				break;
			
			default:
				$placeholder= "";
				break;
		}
		if(isset($paciente)){	
			echo "<input type='text' id='". $campo. "' name='". $campo . "' value=$paciente[0]['" . $campo . "']; />";	
		}else{
			echo "<input type='text' id='" . $campo . "' name='" . $campo . "' placeholder = '" . $placeholder . "'/>";	
		}
	}
	?>
		<div id="form-wraper">
			<form action="cadastrarPaciente.php" method="POST">	
				<h1>Cadastrar Paciente </h1>		
				<div class="form-group">
					<label>Nome:</label>
					<?php renderizarCampo("nome");?>					
				</div>

				<div class="form-group">
					<label>Endereço:</label>
					<?php renderizarCampo("endereco");?>					
				</div>

				<div class="form-group">
					<label>Telefone:</label>
					<?php renderizarCampo("telefone");?>					
				</div>

				<div class="form-group">
					<label>Email:</label>
					<?php renderizarCampo("email");?>
				</div>

				<div class="form-group">
					<label>Data de Nascimento:</label>
					<?php renderizarCampo("dt-nascimento");?>
				</div>

				<input type="submit" class="button" name="cadastrar" value="Cadastrar" />
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
		PacienteVd::validar();
		$ctr = new PacienteCtr();

		$ctr->salvar();
		
	}catch(Exception $ex){
	?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
<?php
	}
}

?>