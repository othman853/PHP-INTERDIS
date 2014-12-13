<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" >
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/menu.css" type="text/css">

	<title>Menu</title>
	
	<?php include_once '../controller/MenuCtr.class.php'; ?>
</head>
<body>
	<?php 	
		$ctr = new MenuCtr();
		$ctr->gerenciarAcesso();
	?>			
</body>	
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
</html>