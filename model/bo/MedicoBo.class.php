<?php
include_once '../model/dao/GenericoDao.class.php';
include_once '../model/dao/MedicoDao.class.php';
include_once '../model/vd/MedicoVd.class.php';
class MedicoBo{
	private $dao;
	private $genericoDao;

	public function __construct(){
		$this->dao = new MedicoDao();			
	}

	public function getLista(){
		$fields = "crm, nome, telefone, email, celular ";
		$filter = "";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}

	public function getEspecialidades($crm){
		$this->genericoDao = new GenericoDao("VW_ESPECIALIDADE_CRM");

		$fields = "especialidade";
		$filter = "crm = $crm";

		$this->genericoDao->find($fields, $filter);

		return $this->genericoDao->getResultSet();
	}

	public function salvar(){
		$fields = "crm, nome, email, celular, telefone";

		$crm 		= MedicoVd::getCrm();
		$nome 		= Medicovd::getNome();
		$email 		= MedicoVd::getEmail();
		$celular 	= MedicoVd::getCelular();
		$telefone 	= MedicoVd::getTelefone();

		$values = "'$crm', '$nome', '$email', '$celular', '$telefone'";

		$this->dao->insert($fields, $values);
	}

	public function buscar($crm){
		$fields = "crm, nome, email, telefone, celular";
		$filter = "crm = $crm";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}

	public function excluir($crm) {		
		
		$this->genericoDao = new GenericoDao("ESPEC_MEDICO");

		$filter = "crm = $crm";
		
		$this->genericoDao->delete($filter);
		$this->dao->delete($filter);
	}

	public function alterar($crm){
		$crm 			= MedicoVd::getCrm();
		$nome 			= MedicoVd::getNome();
		$email 			= MedicoVd::getEmail();
		$telefone 		= MedicoVd::getTelefone();
		$celular 		= MedicoVd::getCelular();		

		$values = "crm = $crm, nome = '$nome', celular= '$celular', telefone = '$telefone', email = '$email', celular = '$celular'";
		$filter = "crm = $crm";

		$this->dao->update($values, $filter);
	}
}
?>