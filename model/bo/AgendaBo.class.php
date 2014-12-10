<?php

include_once '../model/dao/AgendaDao.class.php';

class AgendaBo{

	private $dao;

	public function __construct(){
		$this->dao = new AgendaDao();
	}

	public function getLista(){
			$fields = "crm, nome_medico, dia, hora, estado, descricao_estado";
			$filter = "";

			$this->dao->find($fields, $filter);
			
			return $this->dao->getResultSet();
	}

	public function marcar(){

	}
}

?>