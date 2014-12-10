<?php
include_once '../controller/MedicoCtr.class.php';

if(isset($_GET['id'])){

		$ctr = new MedicoCtr();

		$ctr->excluir($_GET['id']);
}

?>