$(document).ready(function(){

	// var modal = $("#dialog").dialog();

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
				$("#medico").val("1");
				$(this).dialog("close");
			}
		},
		position: {
			my: "left top",
			at: "left top",
			of: window
		}				
	});		

	$("#btn-medico").on("click", function(e) {
		e.preventDefault();

		$("#dialog").html("");

		$("#dialog").dialog("option", "title", "Loading...").dialog("open");

		$("#dialog").load("bloquearAcesso.html", function() {
			$(this).dialog("option", "title", $(this).find("h1").text());
			$(this).find("h1").remove();
		});
	});

	// open: function(event, ui)
	// 	{
	// 		var textarea = $('<textarea style="height: 276px;">');
	// 		$(textarea).redactor({
	// 			focus: true,
	// 			maxHeight: 300,
	// 			initCallback: function()
	// 			{
	// 				this.code.set('<p>Lorem...</p>');
	// 			}
	// 		});
	// 	}	
});