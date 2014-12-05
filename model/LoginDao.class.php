<?php
include_once 'Dao.class.php';

class LoginDao extends Dao{
	public function __construct(){
		parent::__construct('usuario');
	}
}

?>