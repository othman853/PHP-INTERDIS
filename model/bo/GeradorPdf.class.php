<?php
/******************************************************************************/
// Arquivo: meuPrimeiroGeradorPDF.php
// Este arquivo é parte integrante do artigo:
// Gerando Documentos PDF com a Classe FPDF no PHP
// Autor: José Vanol Jr. Data: 12/07/2010
/******************************************************************************/

//Incluindo o arquivo onde está a Classe FPDF
require_once("lib/fpdf.php");

//Definindo o diretório das fontes
define("FPDF_FONTPATH","font/");

//Iniciando o construtor FPDF
$pdf = new FPDF();

//Chamando o método para adicionar página
$pdf->AddPage();

//Posicionando o cursor
// "X" em milímetros de cima para baixo
// "Y" em milímetros da esquerda para a direita
$pdf->SetXY(25, 25); // SetXY($x, $y);

//Adicionando uma imagem (Disponível em: http://img.vivaolinux.com.br/imagens/layout/linux-logo-002.jpg)
$pdf->Image("image/linux-logo-002.jpg"); //Image($arquivo);

// Definindo nova posição do cursor
$pdf->SetXY(70, 25);

//Definindo a fonte
$pdf->SetFont("Helvetica", "B", 12); //SetFont($fonte, $estilo, $tamanho);

//Inserindo célula de texto
$pdf->Cell(0, 5, "Gerando Documentos PDF com a Classe FPDF no PHP");

// Definindo nova posição do cursor
$pdf->SetXY(115, 33);

//Inserindo célula de texto
$pdf->Cell(0, 5, "== Artigo 01 =="); //Cell($h, $w, $txt);

//Definindo novamente a fonte
$pdf->SetFont("Helvetica", "", 11);

// Definindo nova posição do cursor
$pdf->SetXY(120, 38);

//Inserindo célula de texto
$pdf->Cell(0, 5, "José Vanol Jr.");

//Inserindo uma linha divisória
$pdf->Line(25, 45, 185, 45);

// Definindo nova posição do cursor
$pdf->SetXY(25, 50);

//Texto
$txt="Introdução ..."; // Todo o texto a ser gravado com quebra de linha automática

//Inserindo o texto com quebra de linha automática
$pdf->MultiCell(160,5,$txt);

// Gerando um rodapé simples
$pdf->Line(25, 270, 185, 270); // insere linha divisória
$pdf->SetXY(25,270); //posição para o texto
$data=date("d/m/Y H:i:s"); //pegando data e hora da criação do PDF
$conteudo=$data." Pág. ".$pdf->PageNo(); //pegando o número da página
$texto="www.vivaolinux.com.br";
$pdf->Cell(80,5,$texto,0,0,"L"); //Insere célula de texto alinhado à esquerda
$pdf->Cell(80,5,$conteudo,0,0,"R"); //Insere célula de texto alinhado à direita
//Gerando o arquivo PDF
$pdf->Output("arquivo.pdf","D");
//Fim do arquivo
?> 