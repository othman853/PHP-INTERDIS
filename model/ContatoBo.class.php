<?php

include_once 'ContatoVd.class.php';
include_once 'ContatoDao.class.php';

class ContatoBo{
	private $dao;

	public function __construct($executarValidacao){

		session_start();
		
		if($executarValidacao){
			try{
				ContatoVD::validar();
			}catch(Exception $ex){
				throw new Exception($ex->getMessage());
				
			}
		}		

		$this->dao = new ContatoDao();
	}

	public function __destruct(){
		unset($this->dao);				
	}

	public function salvarContato(){		
		
		$fields = "nome, apelido, telephone, celular, email, cd_usuario, dt_nasc";

		$dataSeparada = explode("/",ContatoVd::getdtNascimento());

		$filtroMascaras = array('('=>'', ')'=>'', '-'=>'');

		$nome 		= "'" . ContatoVd::getNome() 	. "'";
		$apelido 	= "'" . ContatoVd::getApelido() . "'";
		$telefone  	= "'" . strtr(ContatoVd::getTelefone(), $filtroMascaras)  . "'";
		$celular 	= "'" . strtr(ContatoVd::getCelular(), $filtroMascaras)   . "'";
		$email 		= "'" . ContatoVd::getEmail()   . "'";		
		$cd_usuario = "'" . $_SESSION['cd_usuario'] . "'";
		$dt_nasc 	= "'" . $dataSeparada[2] . "-" . $dataSeparada[1] . "-" . $dataSeparada[0] . "'";

		$values = $nome . "," . $apelido . "," . $telefone . "," . $celular . "," . $email . "," . $cd_usuario . " ," . $dt_nasc;

		$result = $this->dao->insert($fields, $values);

		return $result > 0;		
	}

	public function getListaDeContatos(){
		$fields = "nome, apelido, celular, telephone";
		$filter = "";

		$this->dao->find($fields, $filter);

		return $this->dao->getResultSet();
	}
}

?>