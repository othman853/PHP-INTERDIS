function redirecionarParaDeletar(nomeDoContato){
	window.location.href="../controller/DeletarCtr.php/removerContato/?nome=" + nomeDoContato;
}

$(document).ready(function(){
	$('.celular').mask('(99)9999-9999');
	$('.telefone').mask('(99)9999-9999');

	$('.button-delete').children().click(function(e){
		e.preventDefault();

		redirecionarParaDeletar($(this).attr('href'));
	});
});