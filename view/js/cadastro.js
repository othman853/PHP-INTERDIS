$(document).ready(function(){
	console.log("Ready");

	$(".crm").mask("9999999999");
	console.log("CRM masked.");

	$(".telefone").mask("(99)9999-9999");
	console.log("Telefone masked.");

	$(".celular").mask("(99)9999-9999");
	console.log("celular masked");

	$(".dt-nascimento").mask("99/99/9999");
	console.log("dt-nascimento masked");

	$(".dia").mask("99/99/9999");

	$(".hora").mask("99:99");
});