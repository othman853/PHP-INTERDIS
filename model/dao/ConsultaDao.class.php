<?php

include_once 'Dao.class.php';

class ConsultaDao extends Dao{
	public function __construct(){
		parent::__construct('VW_CONSULTA');
	}
}