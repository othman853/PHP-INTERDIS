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

}
?>