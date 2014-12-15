<?php

class ViewUtils{
	public static function converterDataParaPadraoBrasileiro($data){
		$dataSeparada = explode("-", $data);

		return $dataSeparada[2] . "/" . $dataSeparada[1] . "/" . $dataSeparada[0];
	}

	public static function restringirAcesso($nivelUsuario){
		session_start();
		if(!isset($_SESSION['usuario'])){
			header("Location: requisitarLogin.html");
		}

		if($_SESSION['nivel_usuario'] != $nivelUsuario){
			header("Location: bloquearAcesso.html");
		}
	}
}

?>