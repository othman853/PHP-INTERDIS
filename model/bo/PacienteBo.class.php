<?php
include_once '../model/dao/PacienteDao.class.php';
include_once '../model/vd/PacienteVd.class.php';

class PacienteBo{
	private $dao;

	public function __construct(){
			$this->dao = new PacienteDao();
	}

	public function getLista(){
		$fields = "cod_paciente, nome, endereco, telefone, email, dt_nascimento";
		$filter = "";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}

	public function salvar(){
		$fields = "nome, endereco, telefone, email, dt_nascimento";

		$nome 			= PacienteVd::getNome();
		$endereco 		= PacienteVd::getEndereco();
		$telefone 		= PacienteVd::getTelefone();
		$email 			= PacienteVd::getEmail();
		$dtNascimento 	= PacienteVd::getDtNascimento();

		$values = "'$nome', '$endereco', '$telefone', '$email', '$dtNascimento'";

		$this->dao->insert($fields, $values);
	}

	public function buscar($cod_paciente){
		$fields = "nome, endereco, telefone, email, dt_nascimento";
		$filter = "cod_paciente = $cod_paciente";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}

	public function alterar(){

	}

	public function excluir($codPaciente){
		$filter = "cod_paciente = $codPaciente";

		$this->dao->delete($filter);
	}
}

?>