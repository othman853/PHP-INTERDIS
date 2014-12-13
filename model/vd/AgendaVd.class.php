<?php

class AgendaVd{

	private static $dia;
	private static $hora;
	private static $estado;

	public static function validar(){

		if(!isset($_POST['hora'])){
			throw new Exception("Digita a hora.");			
		}

		if(!isset($_POST['dia'])){
			throw new Exception("Digita o dia da agenda.");
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

		self::$dia    = $_POST['dia'];
		self::$hora   = $_POST['hora'];
		self::$estado = 0;

		self::normalizarDados();
	}

	public static function getDia(){
		return self::$dia;
	}	

	public static function getHora(){
		return self::$hora;
	}	

	public static function getEstado(){
		return self::$estado;
	}

	private static function normalizarDados(){
		$dataSeparada = explode("/", self::$dia);
		$hora = self::$hora;

		$hora = $hora . ":00";
		$data = $dataSeparada[2] . '-' . $dataSeparada[1] . '-' . $dataSeparada[0];

		self::$hora = $hora;
		self::$dia  = $data;
	}
}

?>