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
		$this->bo->alterar();

		header("Location: medico.php");
	}

	public function buscar($crm){
		return $this->bo->buscar($crm);
	}

	public function excluir($crm){
		$this->bo->excluir($crm);
		
		header("Location: medico.php");
	}
}

?>