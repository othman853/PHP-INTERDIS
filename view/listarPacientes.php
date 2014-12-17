<?php
?>

<script type="text/javascript">
	$(".btn-paciente").on("click", function(e){
		console.log("Click");
		e.preventDefault();
		var codPaciente = $(this).parent().find('.cod-paciente-lista').html(); 
		console.log("Paciente: " + codPaciente);

		$("#cod-paciente").val(codPaciente);
		$("#dialog").dialog("close");
	});
</script>

<?php
include_once '../controller/PacienteCtr.class.php';

$ctr = new PacienteCtr();

$pacientes = $ctr->getLista();

foreach ($pacientes as $paciente) {
	?>
		<div class="form-group">
			<label class='cod-paciente-lista'><?php echo $paciente['cod_paciente'] ;?> </label>
			<label><?php echo $paciente['nome']; ?></label>
			<button class='btn-paciente button update'>Selecionar</label>
		</div>		
	<?php
}

?>