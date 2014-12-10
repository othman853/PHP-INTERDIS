<?php

include_once 'Dao.class.php';

class AgendaDao extends Dao{

	public function __construct(){
		parent::__construct('VW_AGENDA_MEDICO');
	}
}

?>