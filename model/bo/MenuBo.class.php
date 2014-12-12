<?php

class MenuBo{

	public function __construct(){}

	public function bloquearAcesso(){		
		include '../view/bloquear.html';
	}
					

	public function concederAcesso($nivelDeAcesso){
		echo "<div id='menu'>";
		echo "<div class='menu-line'>";

		if($nivelDeAcesso == 0){			
			$this->desenharOpcaoManterMedico();
			$this->desenharOpcaoManterPaciente();
			echo "</div>";

			echo "<div class='menu-line'>";
			$this->desenharOpcaoAgendas();
			$this->desenharOpcaoConsultas();			
		}

		else if ($nivelDeAcesso == 1){
			$this->desenharOpcaoConsultas();
		}

		else if ($nivelDeAcesso == 2){
			$this->desenharOpcaoManterPaciente();
			$this->desenharOpcaoManterMedico();			
		}

		else if ($nivelDeAcesso == 3){
			$this->desenharOpcaoConsultas();
			$this->desenharOpcaoAgendas();
		}

		echo "</div>";
		echo "</div>";
	}

	private function desenharOpcaoManterMedico(){
		?>
		<div id="manter-medico" class="menu-item">
			<span class="menu-icon fa fa-stethoscope"></span>	
			<span class="menu-legend">Manter Médico</span>	
		</div>
		<?php
	}

	private function desenharOpcaoManterPaciente(){
		?>
		<div id="manter-paciente" class="menu-item">
			<span class="menu-icon fa fa-user"></span>		
			<span class="menu-legend">Manter Paciente</span>	
		</div>
		<?php
	}

	private function desenharOpcaoConsultas(){
		?>
		<div id="consultas" class="menu-item">
			<span class="menu-icon fa fa-file"></span>		
			<span class="menu-legend">Consultas</span>	
		</div>
		<?php
	}

	private function desenharOpcaoAgendas(){
		?>
		<div id="agendas" class="menu-item">
			<span class="menu-icon fa fa-calendar"></span>		
			<span class="menu-legend">Agendas</span>	
		</div>
		<?php
	}
}


?>