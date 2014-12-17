<?php

include_once '../controller/PacienteCtr.class.php';

$ctr = new PacienteCtr();

$pacientes = $ctr->getLista();

foreach ($pacientes as $paciente) {
	?>
		<div class="form-group">
			<label class="dialog-paciente" ><?php echo $paciente['cod_paciente'];?></label>			
			<label><?php echo $paciente['nome'];?></label>
		</div>		
	<?php
}

?>