<?php
class LoginVd{
	private static $login;
	private static $senha;

	public static function validar(){
		if(!isset($_POST['login'])) {
			throw new Exception('Preencha login e senha.');
		}

		if(!isset($_POST['senha'])){
			throw new Exception('Preencha login e senha.');
		}

		self::$login = $_POST['login'];
		self::$senha = $_POST['senha'];
	}

	public static function getLogin(){
		return self::$login;
	}

	public static function getSenha(){
		return self::$senha;
	}

}

?>