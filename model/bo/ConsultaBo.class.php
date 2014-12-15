<?php
include_once '../model/dao/ConsultaDao.class.php';
class ConsultaBo{

	private $dao;

	public function __construct(){
		$this->dao = new ConsultaDao();
		
		if(session_status() == PHP_SESSION_NONE){
    		session_start();	    	
    	}
	}

	public function getLista(){
		$tipoDeUsuario = $_SESSION['nivel_usuario'];
		$codUsuario   = $_SESSION['identificacao_usuario'];

		$fields = "nome_medico, nome_paciente, data_consulta, hora_consulta, situacao";

		$filter = "" ;

		if($tipoDeUsuario == 1){
			$filter = "cod_paciente = " . $codUsuario;
		}else if($tipoDeUsuario == 3){
			$filter = "crm = " . $codUsuario;
		}else{
			$filter = "";
		}

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}
}

?>