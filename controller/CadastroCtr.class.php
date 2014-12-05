<?php
include_once '../model/ContatoBo.class.php';
class CadastroCtr{
	private $bo;

	public function __construct(){
		try{
			$this->bo = new ContatoBo(TRUE);
		}catch(Exception $ex){
			throw new Exception($ex->getMessage());
		}
	}

	public function salvarContato(){
		
		 if($this->bo->salvarContato()){
		 	 header("Location:listar.php");
		 }

		throw new Exception("Não foi possível salvar contato");		
	}
}

?>