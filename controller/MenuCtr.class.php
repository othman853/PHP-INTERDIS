<?php

include_once '../model/ContatoBo.class.php';

class ListarCtr{

	private $bo;

	public function __construct(){

		$this->bo = new ContatoBo(FALSE);

	}

	public function getListaDeContatos(){		
		return $this->bo->getListaDeContatos();
	}

}

?>