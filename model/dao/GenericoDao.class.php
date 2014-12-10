<?php

include_once 'Dao.class.php';

class GenericoDao extends Dao{
	public function __construct($tabela){
		parent::__construct($tabela);
	}
}

?>