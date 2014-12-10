<?php
include_once '../controller/PacienteCtr.class.php';

if(isset($_GET['id'])){

		$ctr = new PacienteCtr();

		$ctr->excluir($_GET['id']);
}

?>