<?php

include_once '../model/bo/PacienteBo.class.php';

class PacienteCtr{

	private $bo;

	public function __construct(){
		$this->bo = new PacienteBo();
	}
	
	public function getLista(){		
		return $this->bo->getLista();
	}

	public function salvar(){
		return $this->bo->salvar();
	}

	public function alterar(){
		return $this->bo->alterar();
	}

	public function excluir(){
		//Busca Paciente para exclusao
		//Redireciona para listagem
	}
}

?>