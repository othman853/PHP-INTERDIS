<?php

include_once '../model/bo/ConsultaBo.class.php';

$bo = new ConsultaBo();

$cod_consulta = $_GET['id'];

$bo->cancelar($cod_consulta);

header("Location: consulta.php");

?>