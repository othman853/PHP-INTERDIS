<?php
include_once 'Dao.class.php';

class MedicoDao extends Dao{

	public function __construct(){
		parent::__construct('MEDICO');
	}
}

?>