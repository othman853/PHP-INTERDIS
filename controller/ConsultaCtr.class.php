<?php

include_once '../model/bo/ConsultaBo.class.php';

class ConsultaCtr{

	private $bo;

	public function __construct(){
		$this->bo = new ConsultaBo();
	}

	public function getLista(){
		return $this->bo->getlista();
	}

	public function salvar(){
		$this->bo->salvar();

		header("Location: consulta.php");
	}

}

?>