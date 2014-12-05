<html>
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/cadastro.css" type="text/css">

	<?php include_once '../controller/CadastroCtr.class.php'; ?>
</head>
<body>
	<div id="cadastro-wrapper">
		<form id="cadastro" method="post" action="cadastro.php">
			<h1 class="title">Cadastro</h1>

			<div class="form-group">
				<label class="form-component" for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" class="form-component input" placeholder="Ex.: José">
			</div>

			<div class="form-group">
					<label class="form-component" for="apelido">Apelido:</label>
					<input type="text" name="apelido" id="apelido" class="form-component input" placeholder="Ex.: Gordo">
				</div>

				<div class="form-group">
					<label class="form-component" for="telefone">Telefone:</label>
					<input type="text" name="telefone" id="telefone" class="form-component input" placeholder="Ex.: (99)9999-9999">
				</div>

				<div class="form-group">
					<label class="form-component" for="celular">Celular:</label>
					<input type="text" name="celular" id="celular" class="form-component input" placeholder="Ex.: (99)9999-9999">
				</div>

				<div class="form-group">
					<label class="form-component" for="email">Email:</label>
					<input type="email" name="email" class="form-component input" placeholder="Ex.: nome@server.com">
				</div>

				<div class="form-group">
					<label class="form-component" for="senha">Data Nasc.:</label>
					<input type="text" name="dtNascimento" id="dt-nascimento" class="form-component input" placeholder="Ex.: 21/05/2014">
				</div>
			
				
			<input type="submit" class="form-component button" name="enviar" value="Cadastrar" />
			<input type="submit" class="form-component button button-cancel" id="cancelar" name="cancelar" value="Cancelar" />

		</form>
	</div>	
</body>

<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/cadastro.js"></script>

<?php

if(isset($_POST['enviar'])){

	try{

		$ctr = new CadastroCtr();
		$ctr->salvarContato();

	}catch(Exception $ex){
		?> 		
			<div class="message fail"> <?php echo $ex->getMessage(); ?></div> 
		<?php
	}
}else if(isset($_POST['cancelar'])){
	header("Location:listar.php");
}
?>
</html>