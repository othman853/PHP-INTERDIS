<html>
	<head>
		<meta charset="UTF-8">
		<title>Cadastrar Paciente</title>

		<?php include_once '../controller/PacienteCtr.class.php';?>
		<?php include_once '../model/vd/PacienteVd.class.php'; ?>
		<link rel="stylesheet" href="css/main.css">

	</head>
	<body>
		<form action="cadastrarPaciente.php" method="POST">
			
			<div class="form-group">
				<label>Nome:</label>
				<input type="text" id="nome" name="nome" placeholder="Ex: Maria Silva"/>				
			</div>

			<div class="form-group">
				<label>Endereço:</label>
				<input type="text" id="endereco" name="endereco" placeholder="Ex: Av. Assis Brasil, 328"/>				
			</div>

			<div class="form-group">
				<label>Telefone:</label>
				<input type="text" id="telefone" name="telefone" placeholder="Ex: (51)3493-3528"/>				
			</div>

			<div class="form-group">
				<label>Email:</label>
				<input type="text" id="email" name="email" placeholder="Ex: maria.silva@gmail.com"/>				
			</div>

			<div class="form-group">
				<label>Data de Nascimento:</label>
				<input type="text" id="dt-nascimento" name="dt-nascimento" placeholder="Ex: 15/10/1989"/>				
			</div>			
		</form>		
	</body>
</html>

<?php
if(isset($_POST['cadastrar'])){
	PacienteVd::validar();
}

?>