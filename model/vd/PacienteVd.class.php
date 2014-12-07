<?php

class PacienteVd{

	private $nome;
	private $endereco;
	private $telefone;
	private $email;
	private $dtNascimento;

	public static function validar(){
		if(!isset($_POST['nome'])){
			throw new Exception("Preencha o nome.");
		}

		if(strlen($_POST['nome']) < 2){
			throw new Exception("O nome deve possuir no mínimo dois caracteres.");			
		}

		if(!isset($_POST['endereco'])){
			throw new Exception("Preencha o endereço.");			
		}

		if(strlen($_POST['endereco']) < 3){
			throw new Exception("O endereço deve ter no mínimo três caracteres.");			
		}

		if(!isset($_POST['telefone'])){
			throw new Exception("Preencha o telefone.");			
		}

		if(strlen($_POST['telefone']) < 13){
			throw new Exception("Telefone inválido.");			
		}

		self::$nome 		= $_POST['nome'];
		self::$endereco 	= $_POST['endereco'];
		self::$telefone 	= $_POST['telefone'];
		self::$email 		= $_POST['email'];
		self::$dtNascimento = $_POST['dt-nascimento'];

		normalizarDados();
	}

	private static function normalizarDados(){

	}

	public static function getNome(){
		return self::$nome;
	}

	public static function getEndereco(){
		return self::$endereco;
	}

	public static function getTelefone(){
		return self::$telefone;
	}

	public static function getEmail(){
		return self::$email;
	}

	public static function getDtNascimento(){
		return self::$dtNascimento;
	}
}
?>