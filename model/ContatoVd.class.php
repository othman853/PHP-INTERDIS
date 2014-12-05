<?php

class ContatoVd{

	private static $nome;
	private static $apelido;
	private static $telefone;
	private static $celular;
	private static $email;
	private static $dtNascimento;

	public static function getNome(){
		return self::$nome;
	}

	public static function getApelido(){
		return self::$apelido;
	}

	public static function getTelefone(){
		return self::$telefone;
	}

	public static function getCelular(){
		return self::$celular;
	}

	public static function getEmail(){
		return self::$email;
	}

	public static function getDtNascimento(){
		return self::$dtNascimento;
	}

	public static function validar(){

		if(!isset($_POST['nome']) || empty($_POST['nome'])){			
			throw new Exception("Nome inválido");
		}

		if(!isset($_POST['apelido']) || empty($_POST['apelido'])){			
			throw new Exception("Apelido inválido.");
		}

		if(!isset($_POST['telefone']) || empty($_POST['telefone'])){			
			throw new Exception("Telefone inválido.");
		}

		if(strlen($_POST['telefone']) < 13){
			throw new Exception("Telefone inválido.");
		}

		if(!isset($_POST['celular']) || empty($_POST['celular'])){			
			throw new Exception("Celular inválido.");
		}

		if(strlen($_POST['celular']) < 13){
			throw new Exception("Celular inválido.");
		}

		if(!isset($_POST['email']) || empty($_POST['email'])){			
			throw new Exception("Email inválido.");
		}

		if(!isset($_POST['dtNascimento']) || empty($_POST['dtNascimento'])){			
			throw new Exception("Data de nascimento inválida.");			

		}

		self::$nome     	= $_POST['nome'];
		self::$apelido  	= $_POST['apelido'];
		self::$telefone 	= $_POST['telefone'];
		self::$celular  	= $_POST['celular'];
		self::$email    	= $_POST['email'];
		self::$dtNascimento = $_POST['dtNascimento'];
	}
}

?>