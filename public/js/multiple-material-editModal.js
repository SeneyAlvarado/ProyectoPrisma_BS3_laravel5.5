$().ready(function() 
	{
		$('.pasar').click(function() { return !$('#origen_edit option:selected').remove().appendTo('#destino_edit'); });  
        $('.quitar').click(function() { return !$('#destino_edit option:selected').remove().appendTo('#origen_edit'); });
		$('.pasartodos').click(function() { $('#origen_edit option').each(function() { $(this).remove().appendTo('#destino_edit'); }); });
		$('.quitartodos').click(function() { $('#destino_edit option').each(function() { $(this).remove().appendTo('#origen_edit'); }); });
		//$('.submit').click(function() { $('#destino_edit option').prop('selected', 'selected'); });
	});