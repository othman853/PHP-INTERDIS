<?php
include_once 'model/LoginVd.class.php';
include_once 'model/LoginDao.class.php';

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

		$this->dao->find('cd_usuario, senha',"cd_usuario = '" . $login . "'");
		$usuario = $this->dao->getResultSet();

		if($usuario == NULL){
			return false;
		}

		foreach ($usuario as $u) {
			if($u['cd_usuario'] == $login &&
			   $u['senha']   == $senha){
			   	$_SESSION['cd_usuario'] = $u['cd_usuario'];
				return true;
			}
		}		
		
		return false;
	}
}

?>