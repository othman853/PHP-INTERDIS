$(document).ready(function(){

	$("#dialog").dialog(
	{
		autoOpen: false,
		modal: true,
		width:window.innerWidth - 10,
		height:window.innerHeight - 10,
		buttons: {
			"Fechar": function() {
				$(this).dialog("close");
			},

			"Selecionar Médico": function(){
				$("#cod-paciente").val($('.dialog-paciente').html());				
				$(this).dialog("close");
			}
		},
		position: {
			my: "left top",
			at: "left top",
			of: window
		}				
	});		

	var abreDialog = function(){		
		$("#dialog").html("");

		$("#dialog").dialog("option", "title", "Loading...").dialog("open");

		$("#dialog").load("listarPacientes.php", function() {
			$(this).dialog("option", "title", $(this).find("h1").text());
			$(this).find("h1").remove();
		});
	}

	$("#btn-paciente").on("click", function(e) {
		e.preventDefault();		
		abreDialog();		
	});	
});