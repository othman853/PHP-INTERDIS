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

		$this->dao->find('cod_usuario, usuario, senha, nivel',"usuario = '" . $login . "'");
		$usuarios = $this->dao->getResultSet();

		if($usuarios == NULL){
			return false;
		}

		foreach ($usuarios as $usuario) {
			if($usuario['usuario'] == $login &&
			   $usuario['senha']   == $senha){

			   	$identificacaoUsuario = 0;

				switch($usuario['nivel']){
					case 0:
						$daoGenerico = new GenericoDao("ADMINISTRADOR");

						$fields = "cod_admin";
						$filter = "cod_usuario = $usuario['cod_usuario']";

						$this->daoGenerico->find($fields, $filter);
						$result = $this->daoGenerico->getResultSet();

						$identificacaoUsuario = $result[0]['cod_admin'];
					break;					

					case 1:
						$daoGenerico = new GenericoDao("PACIENTE");

						$fields = "";
						$filter = "";

					break;

					case 2:
						$daoGenerico = new GenericoDao("ATENDENTE");

						$fields = "";
						$filter = "";

					break;

					case 3:
						$daoGenerico = new GenericoDao("MEDICO");

						$fields = "";
						$filter = "";
					break;

					default:
					break;
				}

			   	$_SESSION['usuario'] 			   = $usuario['usuario'];
			    $_SESSION['nivel_usuario'] 		   = $usuario['nivel'];
			    $_SESSION['identificacao_usuario'] = $identificacaoUsuario;
			    
				return true;
			}
		}		
		
		return false;
	}
}

?>