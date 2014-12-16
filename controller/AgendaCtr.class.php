<?php

include_once '../model/bo/AgendaBo.class.php';

class AgendaCtr{

	private $bo;

	public function __construct(){
		$this->bo = new AgendaBo();		
	}

	public function getLista(){
		return $this->bo->getLista();
	}

	public function getListaDisponiveis(){
		return $this->bo->getListaDisponiveis();
	}

	public function salvar(){
		$this->bo->salvar();
		header("Location:agenda.php");
	}

	public function gerarXml(){
		$this->bo->gerarXml();
		header("Location:agenda.php");
	}

}
?>