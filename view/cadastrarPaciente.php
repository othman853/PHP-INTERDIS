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
	?>
		<div id="form-wraper">
			<?php
				if(isset($_GET['id'])){
					$id = $_GET['id'];

					$action = "cadastrarPaciente.php?id=$id";
				}else{
					$action = "cadastrarPaciente.php";
				}
			?>
			<form action= "cadastrarPaciente.php" method="POST">	
				<h1>Cadastrar Paciente </h1>		
				<?php 
					if(isset($_GET['id'])){
						$id = $_GET['id'];
						echo "<input type='hidden' name='cod_paciente' value='$id'>";
					}
				?>
				<div class="form-group">
					<label>Nome:</label>					
					<input type="text" name="nome" value=<?php $nome = (isset($_GET['id'])) ? $paciente[0]['nome'] : ""; echo $nome;?> >
				</div>

				<div class="form-group">
					<label>Endereço:</label>					
					<input type="text" name="endereco" value=<?php $endereco = (isset($_GET['id'])) ? $paciente[0]['endereco'] : ""; echo $endereco;?> >
				</div>

				<div class="form-group">
					<label>Telefone:</label>					
					<input type="text" class="telefone" name="telefone" value=<?php $telefone = (isset($_GET['id'])) ? $paciente[0]['telefone'] : ""; echo $telefone;?> >
				</div>

				<div class="form-group">
					<label>Email:</label>					
					<input type="text" name="email" value=<?php $email = (isset($_GET['id'])) ? $paciente[0]['email'] : ""; echo $email;?> >
				</div>

				<div class="form-group">
					<label>Data de Nascimento:</label>					
					<input type="text" class="dt-nascimento" name="dt-nascimento" value=<?php $dt_nascimento = (isset($_GET['id'])) ? $paciente[0]['dt_nascimento'] : ""; echo $dt_nascimento;?> >
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

		if(isset($_POST['cod_paciente'])){		
			$id = $_POST['cod_paciente'];

			$ctr->alterar($id);			
		}

		else{
			$ctr->salvar();
		}
		
	}catch(Exception $ex){
	?>
		<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
<?php
	}
}

?>