$(function () {
	$('#btnAdd').click(function () {
		var num 		= $('.clonedInput').length,
			newNum 		= new Number(num + 1),
			newElem 	= $('#entry' + num).clone().attr('id','entry' + newNum).fadeIn('slow');
		
		newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_reference').attr('name', 'ID' + newNum + '_reference').html('Entry #' + newNum);
		
		newElem.find('.label_fn').attr('for', 'ID' + newNum + '_aluno');
		newElem.find('.input_fn').attr('id', 'ID' + newNum + '_aluno').attr('name', 'ID' + newNum + '_aluno').val('');
		
		newElem.find('.label_ln').attr('for', 'ID' + newNum + '_turma');
		newElem.find('.input_ln').attr('id', 'ID' + newNum + '_turma').attr('name', 'ID' + newNum + '_turma').val('');
		
		//$('#entry' + num).after(newElem);
		//$('#ID' + newNum + '_title').focus();
		
		$('#btnDel').attr('disabled', false);
		
		if(newNum == 5)
			$('#btnAdd').attr('disabled', true).prop('value', "Você chegou ao limite");
	});
	
	$('#btnDel').click(function () {
		if(confirm("Você tem certeza que deseja remover essa sessão?"))
			{
				var num = $('.clonedInput').length;
				$('#entry' + num).slideUp('slow', function () {$(this).remove();
					if(num -1 === 1)
						$('#btnDel').attr('disabled', true);
						$('#btnAdd').attr('disabled', false).prop('value', "Adicionar sessão");
				});
			}
		return false;
		
		$('#btnAdd').attr('disabled', false);
	});
	
	$('#btnDel').attr('disabled', true);
});