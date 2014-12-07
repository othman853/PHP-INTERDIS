<?php
include_once '../model/dao/PacienteDao.class.php';

class PacienteBo{
	private $dao;

	public function __construct(){
			$this->dao = new PacienteDao();
	}

	public function getLista(){
		$fields = "nome, endereco, telefone, email, dt_nascimento";
		$filter = "";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}

	public function salvar(){

	}

	public function alterar(){

	}

	public function excluir(){
		
	}
}

?>