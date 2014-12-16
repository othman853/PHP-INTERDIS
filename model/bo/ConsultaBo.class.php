<?php
include_once '../model/dao/ConsultaDao.class.php';
include_once '../model/dao/GenericoDao.class.php';
include_once '../model/vd/ConsultaVd.class.php';

class ConsultaBo{

	private $dao;
	private $genericoDao;

	public function __construct(){
		$this->dao = new ConsultaDao();
		$this->genericoDao = new GenericoDao("VW_CONSULTA");
		
		if(session_status() == PHP_SESSION_NONE){
    		session_start();	    	
    	}
	}

	public function getLista(){
		$tipoDeUsuario = $_SESSION['nivel_usuario'];
		$codUsuario   = $_SESSION['identificacao_usuario'];

		$fields = "cod_consulta, nome_medico, nome_paciente, data_consulta, hora_consulta, situacao";

		$filter = "" ;

		if($tipoDeUsuario == 1){
			$filter = "cod_paciente = " . $codUsuario;
		}else if($tipoDeUsuario == 3){
			$filter = "crm = " . $codUsuario;
		}else{
			$filter = "";
		}

		$this->genericoDao->find($fields, $filter);

		return $this->genericoDao->getResultSet();
	}

	public function salvar(){
		$fields = "crm_medico, cod_paciente, data_consulta, hora_consulta";

		$crm  		  = ConsultaVd::getCrm();
		$codPaciente  = ConsultaVd::getCodPaciente();
		$dataConsulta = ConsultaVd::getDataConsulta();
		$horaConsulta = ConsultaVd::getHoraConsulta();

		$values = $crm . ", " . $codPaciente . ", '" . $dataConsulta ."', '" . $horaConsulta . "'";

		$this->dao->insert($fields, $values);
	}

	public function cancelar($cod_consulta){
		$fieldValue = "situacao = 2";
		$filter= "cod_consulta = " . $cod_consulta;

		$this->dao->update($fieldValue, $filter);
	}
}

?>