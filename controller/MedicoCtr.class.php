<?php
include_once '../model/bo/MedicoBo.class.php';
class MedicoCtr{

	private $bo;

	public function __construct(){
		$this->bo = new MedicoBo();
	}

	public function getLista(){
		return $this->bo->getLista();
	}

	public function salvar(){
		$this->bo->salvar();
		header("Location: medico.php");
	}

	public function alterar(){

	}

	public function excluir($codMedico){
		$this->bo->excluir($codMedico);
		
		header("Location: medico.php");
	}
}

?>