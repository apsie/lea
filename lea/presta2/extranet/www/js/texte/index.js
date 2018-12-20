function getTexte()
{
	$j.ajax({
	url : "./index.php?page=ajax&noTemplate=1",
	dataType : "html",
	
	data : {
	action : 'liste_texte',
	id_texte_key : $j('#chapitre').val()
	
	},success: function(html){

		$j('.contenu_flex').html(html);

		$j('#myTable').tablesorter({ widgets: ['zebra'] });
			
	}});
}

function formTexte(id_texte)
{
	$j.ajax({
		url : "./index.php?page=ajax&noTemplate=1",
		dataType : "html",
		
		data : {
		action : 'maj_texte',
		id_texte : id_texte 
		
		},success: function(html){

			
			$j('#div_common').attr('title','Gestion du texte');
			
			$j('#div_common').dialog(
					{ width : 550,
					  height : 150
					 }
					);

			$j('#div_common').html(html);
			
		
		}});
}