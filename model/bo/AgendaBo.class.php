<?php

include_once '../model/dao/AgendaDao.class.php';
include_once '../model/dao/GenericoDao.class.php';
include_once '../model/vd/AgendaVd.class.php';

class AgendaBo{

	private $dao;
	private static $genericoDao;

	public function __construct(){
		$this->dao = new AgendaDao();		
		
    	if(session_status() == PHP_SESSION_NONE){
    		session_start();	    	
    	}
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

	public function getListaDisponiveis(){
		if(self::$genericoDao == NULL){
		 	self::$genericoDao = new GenericoDao("VW_AGENDA_MEDICO");
		}

		$fields = "crm, nome_medico, dia, hora, estado";
		$filter = "estado = 0";

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

	public function gerarXml(){

		if(self::$genericoDao == NULL){
			self::$genericoDao = new GenericoDao("VW_AGENDA_MEDICO");
		}

		$fields = "crm, nome_medico, dia, hora, descricao_estado";
		$filter = "crm = " . $_SESSION['identificacao_usuario'];

		self::$genericoDao->find($fields, $filter);

		$agendas = self::$genericoDao->getResultSet();

		$documento = new DOMDocument("1.0", "ISO-8859-1");
		$documento->preserveWhiteSpace = FALSE;
		$documento->formatOutput = TRUE;

		$root = $documento->createElement("agendas");

		foreach ($agendas as $agenda) {
			$dia 	= $documento->createElement("dia", $agenda['dia']);
			$hora   = $documento->createElement("hora", $agenda['hora']);
			$estado = $documento->createElement("estado", $agenda['descricao_estado']);

			$agenda = $documento->createElement("agenda");	

			$agenda->appendChild($dia);
			$agenda->appendChild($hora);
			$agenda->appendChild($estado);

			$root->appendChild($agenda);
		}

		$documento->appendChild($root);

		$dia = time();		

		$documento->save("/var/www/html/" . $agendas[0]['crm'] . "_" .  time() .".xml");
	}
}
?>