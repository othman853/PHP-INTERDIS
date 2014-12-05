<?php
include_once '../model/ContatoDao.class.php';

removerContato();

function removerContato(){
	$dao = new ContatoDao();
	$filter = "nome = '" . strtr($_GET['nome'], array("%20"=>" ")) . "'";

	// $result = 1;
	$result = $dao->delete($filter);
	if($result > 0){
		header("Location: ../../../view/listar.php");
	}else{
		echo "Erro:: " . $_GET['nome'];
	}
}	

?>