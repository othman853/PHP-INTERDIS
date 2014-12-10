<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" >
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/menu.css" type="text/css">
	
	<?php include_once '../controller/MenuCtr.class.php'; ?>
</head>
<body>
	<div id="menu">						
		<div class="menu-line">
			<div id="manter-medico" class="menu-item">
				<span class="menu-icon fa fa-stethoscope"></span>	
				<span class="menu-legend">Manter Médico</span>	
			</div>
			<div id="manter-paciente" class="menu-item">
				<span class="menu-icon fa fa-user"></span>		
				<span class="menu-legend">Manter Paciente</span>	
			</div>
		</div>

		<div class="menu-line">
			<div class="menu-item">
				<span class="menu-icon fa fa-calendar"></span>		
				<span class="menu-legend">Agendas Médicas</span>	
			</div>
			<div class="menu-item">
				<span class="menu-icon fa fa-file"></span>		
				<span class="menu-legend">Marcar Consultas</span>	
			</div>
		</div>		
	</div>	
</body>	
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
</html>