<?php

include_once '../model/dao/AgendaDao.class.php';
include_once '../model/dao/GenericoDao.class.php';
include_once '../model/vd/AgendaVd.class.php';

class AgendaBo{

	private $dao;
	private static $genericoDao;

	public function __construct(){
		$this->dao = new AgendaDao();
		session_start();
	}

	public function getLista(){
		
		if(self::$genericoDao == NULL){
		 	self::$genericoDao = new GenericoDao("VW_AGENDA_MEDICO");
		}

		$fields = "crm, dia, hora, estado, descricao_estado";
		$filter = "crm = " . $_SESSION['identificacao_usuario'];

		self::$genericoDao->find($fields, $filter);
			
		return self::$genericoDao->getResultSet();
	}

	public function salvar(){
		$fields = "crm, dia, hora, estado";

		$crm    = $_SESSION['identificacao_usuario'];
		$dia    = AgendaVd::getDia();
		$hora   = AgendaVd::getHora();
		$estado = AgendaVd::getEstado();

		$values = $crm . ", '" . $dia . "', '" . $hora . "', " . $estado;

		$this->dao->insert($fields, $values);
	}

	public function alterarEstado($dia, $hora, $estado){

		$crm = $_SESSION['identificacao_usuario'];				

		
		$field = "estado = $estado";		

		$filter = "crm  = $crm  AND ".
				  "dia  = '" . $dia . "' AND ".
				  "hora = '" . $hora . "'";

 		if($estado == 100){
	   		$this->dao->delete($filter);			
	   	}

	   	else{			
		 	$this->dao->update($field, $filter);
	   	}		
	}
}

?>