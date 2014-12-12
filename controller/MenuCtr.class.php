<?php
include_once '../model/bo/MenuBo.class.php';

class MenuCtr{

	private $bo;

	public function __construct(){		
		session_start();

		$this->bo = new MenuBo();
	}
	
	public function gerenciarAcesso(){		
		if(!isset($_SESSION['usuario'])){
			$this->bloquearAcesso();
		}else{
			$this->concederAcesso();
		}		
	}

	private function bloquearAcesso(){
		$this->bo->bloquearAcesso();
	}

	private function concederAcesso(){
		$nivelDeAcesso = $_SESSION['nivel_usuario'];

		$this->bo->concederAcesso($nivelDeAcesso);
	}

}

?>