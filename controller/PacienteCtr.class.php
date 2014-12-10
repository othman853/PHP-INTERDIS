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
		$this->bo->salvar();
		header("Location: paciente.php");
	}

	public function alterar(){
		$this->bo->alterar();
		header("Location: paciente.php");
	}

	public function buscar($cod_paciente){
		return $this->bo->buscar($cod_paciente);
	}

	public function excluir($codPaciente){
		$this->bo->excluir($codPaciente);
		header("Location: paciente.php");
	}
}

?>