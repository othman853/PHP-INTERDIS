<?php
include_once '../model/dao/GenericoDao.class.php';
include_once 'ViewUtils.class.php';

class GeradorDePdf{

	private static $x;
	private static $y;

	private static $largura;
	private static $altura; 

	private static $dao;

	private static $pdf;	

	// W -> 595.28
	// H -> 841.89		
	public static function gerar($codConsulta){				
		self::inicializar();

		$tamanhoCelula = 0;

		if($_SESSION['nivel_usuario'] == 2){
			$tamanhoCelula = 100;			
		}

		else if ($_SESSION['nivel_usuario'] == 3){
			$tamanhoCelula = 80;
		}						

		self::novaPagina();		

		$consultas = self::buscarDados($codConsulta);
		
		foreach ($consultas as $consulta) {	

			if((self::$y + $tamanhoCelula) > self::$altura){
				self::novaPagina();
			}

			self::desenharConsulta($consulta);
		}		

		$nomeArquivo = date('dmYHis');

		self::$pdf->Output($nomeArquivo . ".pdf","D");	
	}

	private static function inicializar(){
		self::$altura  = 821;
		self::$largura = 575;

		session_start();

		require_once("../model/lib/fpdf.php");		
		define("FPDF_FONTPATH","../model/font/");		

		self::$pdf = new FPDF('p', 'pt', 'A4');		
	}

	private static function novaPagina(){
		self::$pdf->AddPage();				

		self::$pdf->Rect(10, 10, self::$largura, self::$altura);

		self::desenharCabecalho();

		self::$y = 25;
		self::$x = 10;
	}

	private static function buscarDados($codConsulta){
		if(self::$dao == NULL){
			self::$dao = new GenericoDao("VW_CONSULTA");
		}

		$filter = "cod_consulta = $codConsulta";

		if($_SESSION['nivel_usuario'] == 3){
			$filter = $filter . " AND crm = " . $_SESSION['identificacao_usuario'];
		}		

		$fields = "nome_paciente, data_consulta, hora_consulta, situacao";

		if($_SESSION['nivel_usuario'] == 2){
			$fields = $fields . ", nome_medico";
		}

		self::$dao->find($fields, $filter);

		return self::$dao->getResultSet();
	}

	private static function desenharCabecalho(){
		self::$pdf->SetFont("Helvetica", "", 12);
		self::$pdf->SetXY(15,10);
		self::$pdf->Cell(0,15, "Consultas");

		$data 		 = date("d/m/Y");
		$hora 		 = date("H:i:s");

		$posicaoData = (self::$largura / 2) - 50;
		$posicaoHora = $posicaoData + (self::$largura / 2);

		self::$pdf->SetXY($posicaoData,10);
		self::$pdf->Cell(0,15, $data);

		self::$pdf->SetXY($posicaoHora,10);
		self::$pdf->Cell(0,15, $hora);

		self::$pdf->Line(10, 25, self::$largura + 10, 25);
	}

	private static function desenharConsulta($consulta){		
		$largura = 575;
		$altura  = 30;
		$borda   = 1;

		$alturaRetangulo = 0;
			
		self::escreverLinha(self::$x, self::$y, $largura, "Paciente", $consulta['nome_paciente']);
		self::$y += 20;		
		$alturaRetangulo += 20;	

		if($_SESSION['nivel_usuario'] == 2){
			self::escreverLinha(self::$x, self::$y, $largura, "Medico", $consulta['nome_medico']);
			self::$y += 20;			
			$alturaRetangulo += 20;
		}

		self::escreverLinha(self::$x, self::$y, $largura, "Data", ViewUtils::converterDataParaPadraoBrasileiro($consulta['data_consulta']));
		self::$y += 20;				
		$alturaRetangulo += 20;		

		self::escreverLinha(self::$x, self::$y, $largura, "Hora", $consulta['hora_consulta']);
		self::$y += 20;
		$alturaRetangulo += 20;

		self::escreverLinha(self::$x, self::$y, $largura, "Situacao", $consulta['situacao']);
		self::$y += 20;			
		$alturaRetangulo += 20;		

		self::$pdf->Rect(self::$x, self::$y - $alturaRetangulo, $largura, $alturaRetangulo);		
	}

	private static function label($x, $y, $largura, $texto){
		self::$pdf->SetFont("Helvetica", "B", 11);
		self::$pdf->SetXY($x, $y);		
		self::$pdf->Cell($largura, 20, $texto);			
	}

	private static function texto($x, $y, $largura, $texto){
		self::$pdf->SetFont("Helvetica", "", 11);
		self::$pdf->SetXY($x, $y);		
		self::$pdf->Cell($largura, 20, $texto);
	}

	private static function escreverLinha($x, $y, $largura, $label, $texto){
		self::label($x, $y, $largura, $label);
		self::texto($x+60,$y,$largura,$texto);
	}

}
?> 