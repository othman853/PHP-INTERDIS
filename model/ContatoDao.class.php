<?php
include_once 'Dao.class.php';

class ContatoDao extends Dao{
	public function __construct(){
		parent::__construct('contatos');
	}
}

?>