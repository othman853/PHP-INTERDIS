<?php
include_once 'Dao.class.php';

class PacienteDao extends Dao{
	public function __construct(){
		parent::__construct('PACIENTE');
	}
}

?>