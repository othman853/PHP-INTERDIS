<?php

include_once 'model/bo/LoginBo.class.php';

class LoginCtr{

	private $bo;

	public function __construct(){
		$this->bo = new LoginBo();		
	}

	public function validarCredenciais(){		
		if($this->bo->validarCredenciais()){						
			header("Location:view/menu.php");
		}

		throw new Exception("Credenciais Inválidas");		
	}
}

?>