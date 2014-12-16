<?php

class ConsultaVd{

	private static $crm;
	private static $cod_paciente;
	private static $dia;
	private static $hora;

	public static function validar(){

		if(!isset($_POST['crm'])){
			throw new Exception("CRM inválido.");			
		}

		if(!isset($_POST['cod_paciente'])){
			throw new Exception("Paciente inválido.");			
		}

		$dataSeparada = explode('/', $_POST['dia']);

		if(sizeof($dataSeparada)< 3){
			throw new Exception("A data está em um formato incorreto, utilize: dd/mm/aaaa");			
		}

		$dia = $dataSeparada[0];
		$mes = $dataSeparada[1];
		$ano = $dataSeparada[2];

		if(!checkdate($mes, $dia, $ano)){
			throw new Exception("Data inválida.");			
		}

		$regexHora = '/^[0-9]{2}:[0-9]{2}$/';
		if(!preg_match($regexHora, $_POST['hora'])){
			throw new Exception("A hora está em um formato incorreto, utilize: HH:MM");			
		}

		self::$cod_paciente = $_POST['cod_paciente'];
		self::$crm 			= $_POST['crm'];
		self::$dia    		= $_POST['dia'];
		self::$hora   		= $_POST['hora'];		

		self::normalizarDados();

	}

	private static function normalizarDados(){
		$dataSeparada = explode("/", self::$dia);
		$hora = self::$hora;

		$hora = $hora . ":00";
		$data = $dataSeparada[2] . '-' . $dataSeparada[1] . '-' . $dataSeparada[0];

		self::$hora = $hora;
		self::$dia  = $data;
	}

	public static function getCrm(){
		return self::$crm;
	}

	public static function getCodPaciente(){
		return self::$cod_paciente;
	}

	public static function getDataConsulta(){
		return self::$dia;
	}

	public static function getHoraConsulta(){
		return self::$hora;
	}	
}

?>