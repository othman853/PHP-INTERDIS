<?php

class MedicoVd{

	private static $crm;
	private static $nome;
	private static $email;
	private static $celular;
	private static $telefone;

	
	public static function validar(){
		if(!isset($_POST['crm'])){
			throw new Exception("Digite um CRM.");
		}

		if(strlen($_POST['crm']) < 3){
			throw new Exception("CRM Inválido.");
		}

		if(!isset($_POST['nome'])){
			throw new Exception("Digite um nome.");
		}

		if(strlen($_POST['nome'])< 2){
			throw new Exception("Nome inválido.");
		}

		if(!isset($_POST['telefone'])){
			throw new Exception("Digite um número de telefone.");			
		}

		if(strlen($_POST['telefone'])< 13){
			throw new Exception("Telefone inválido.");			
		}

		if(!isset($_POST['celular'])){
			throw new Exception("Digite um número de celular.");			
		}

		if(strlen($_POST['celular']) < 13){
			throw new Exception("Digite um número de celular válido.");			
		}

		if(!isset($_POST['email'])){
			throw new Exception("Digite um email.");			
		}

		if(strlen($_POST['email'])< 8){
			throw new Exception("Digite um e-mail válido.");			
		}

		self::$crm 		= $_POST['crm'];
		self::$nome 	= $_POST['nome'];
		self::$email 	= $_POST['email'];
		self::$celular 	= $_POST['celular'];
		self::$telefone = $_POST['telefone'];

		self::normalizarDados();
	}

	private static function normalizarDados(){

		$normalizador = array('(' => '', ')' =>'', '-' =>'' );

		self::$celular  = strtr(self::$celular, $normalizador);
		self::$telefone = strtr(self::$telefone, $normalizador);
	}

	public static function getCrm(){
		return self::$crm;
	}

	public static function getNome(){
		return self::$nome;
	}

	public static function getEmail(){
		return self::$email;
	}

	public static function getCelular(){
		return self::$celular;
	}

	public static function getTelefone(){
		return self::$telefone;
	}
}

?>