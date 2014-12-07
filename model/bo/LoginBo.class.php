<?php
include_once 'model/vd/LoginVd.class.php';
include_once 'model/dao/LoginDao.class.php';

class LoginBo{

	private $dao;

	public function __construct(){
		LoginVd::validar();

		session_start();

		$this->dao = new LoginDao();
	}

	public function __destruct(){
		unset($this->dao);		
	}

	public function validarCredenciais(){		
		$login = LoginVd::getLogin();
		$senha = md5(LoginVd::getSenha());

		$this->dao->find('usuario, senha',"usuario = '" . $login . "'");
		$usuarios = $this->dao->getResultSet();

		if($usuarios == NULL){
			return false;
		}

		foreach ($usuarios as $usuario) {
			if($usuario['usuario'] == $login &&
			   $usuario['senha']   == $senha){
			   	$_SESSION['usuario'] = $usuario['usuario'];
				return true;
			}
		}		
		
		return false;
	}
}

?>