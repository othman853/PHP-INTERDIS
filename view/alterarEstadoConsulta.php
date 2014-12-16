<?php

include_once '../model/bo/ConsultaBo.class.php';

$bo = new ConsultaBo();

$cod_consulta = $_GET['id'];
$estado = $_GET['estado'];

if($estado == 1){
	$bo->cancelar($cod_consulta);
}

else if($estado == 2){
	$bo->confirmar($cod_consulta);
}

else if ($estado == 3){
	$bo->excluir($cod_consulta);	
}



header("Location: consulta.php");

?>