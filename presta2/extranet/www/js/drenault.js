(function($) {

$.fn.changeSelectInput = function(){
  
	//console.debug(this);
	
	if( $('select',this).css('display') =='block')
		{
		$('input',this).css('display','block');
		$('input',this).attr('name',$('select',this).attr('name'));
		$('select',this).attr('name','');
		$('select',this).css('display','none');
		}
	else
		{
		$('input',this).css('display','none');
		$('select',this).css('display','block');
		('select',this).attr('name',$('input',this).attr('name'));
		$('input',this).attr('name','');
		}
	
	
};

})(jQuery);