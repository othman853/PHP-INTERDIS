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
		$fields = "crm_medico, cod_paciente, data_consulta, hora_consulta, situacao";

		$crm  		  = ConsultaVd::getCrm();
		$codPaciente  = ConsultaVd::getCodPaciente();
		$dataConsulta = ConsultaVd::getDataConsulta();
		$horaConsulta = ConsultaVd::getHoraConsulta();

		$values = $crm . ", " . $codPaciente . ", '" . $dataConsulta ."', '" . $horaConsulta . "', 0"  ;

		$this->dao->insert($fields, $values);

		$agendaDao = new GenericoDao("AGENDA");

		$fieldValue = "estado = 1";
		$filter	    = "crm = $crm AND dia = $data_consulta AND hora = $hora_consulta";

		$agenda->update($fieldValue, $filter);
	}

	public function cancelar($cod_consulta){
		$fieldValue = "situacao = 2";
		$filter= "cod_consulta = " . $cod_consulta;

		
		$fieldsConsulta = "crm_medico, data_consulta, hora_consulta";		
		$this->dao->find($fieldsConsulta, $filter);

		$consulta = $this->dao->getResultSet();

		$agendaDao = new GenericoDao("AGENDA");

		$fieldValue = "estado = 0";
		$filter	    = "crm = ". $consulta[0]['crm_medico'] . "AND dia = " .  $consulta['data_consulta'] . " AND hora = " . $consulta[0]['hora_consulta'];

		$agenda->update($fieldValue, $filter);


		$this->dao->update($fieldValue, $filter);		
	}

	public function confirmar($cod_consulta){
		$fieldValue = "situacao = 1";
		$filter= "cod_consulta = " . $cod_consulta;

		$this->dao->update($fieldValue, $filter);

		$fieldsConsulta = "crm_medico, data_consulta, hora_consulta";		
		$this->dao->find($fieldsConsulta, $filter);

		$consulta = $this->dao->getResultSet();

		$agendaDao = new GenericoDao("AGENDA");

		$fieldValue = "estado = 2";
		$filter	    = "crm = ". $consulta[0]['crm_medico'] . "AND dia = " .  $consulta['data_consulta'] . " AND hora = " . $consulta[0]['hora_consulta'];

		$agenda->update($fieldValue, $filter);
	}

	public function excluir($cod_consulta){
		$filter = "cod_consulta = " . $cod_consulta;

		$this->dao->delete($filter);
	}
}

?>