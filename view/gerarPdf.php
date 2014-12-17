<?php

include_once '../model/bo/GeradorPdf.class.php';

if(isset($_GET['id'])){
	GeradorDePdf::gerar($_GET['id']);
}
?>