<?php
if(isset($_GET['dia']) && isset($_GET['hora'])){
	include_once '../model/bo/AgendaBo.class.php';

	$dia    = $_GET['dia'];
	$hora   = $_GET['hora'];
	$estado = $_GET['c'];

	$bo = new AgendaBo();

	$bo->alterarEstado($dia, $hora, $estado);

	header("Location:agenda.php");
	
}
?>