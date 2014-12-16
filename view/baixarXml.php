<?php
	header('Content-type: "text/xml";');
	header("Content-disposition: attachment; filename=" . $_GET['nomeArquivo']);
	readfile($_GET['nomeArquivo'] . "");
?>