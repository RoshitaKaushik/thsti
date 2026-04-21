$(document).on('change','.aggr_percent', function(){
   var val = $(this).val();

	if(val<1 || val>100){
		alert('Aggregate percentage between 1 and 100');
		$(this).val('');
	}
});

//count character of given straing
function textareaValidate(id,valuedAllowed)
  {
	var textValidation= /^[a-zA-Z0-9.! ]+$/;
	var text=$("#"+id).val();
	var leng=text.length;
	var i=0;
	if(leng<=valuedAllowed)
	{
		$("#count_"+id).html(leng);
		$("#count_"+id).css('color','#317eeb');
	}
	else
	{
		alert('Only '+valuedAllowed+' Characters Allowed');
		var sub=leng-valuedAllowed;
		var str = text.substring(0, text.length - sub);
		$('#'+id).val(str);
		$("#count_"+id).html(str.length);
		$("#count_"+id).css('color','#ff0000');
		$("#e_"+id).html("Only "+valuedAllowed+" Characters Allowed!");
		$("#e_"+id).css('color','#ff0000');			
		i++;
	}
	if(text.search(textValidation)==-1)
	{
		$("#e_"+id).html("Please Enter proper value!");
		$("#e_"+id).css('color','#ff0000');	
		i++;
	}
	else
	{
		$("#e_"+id).html("");
	}
	if(i)
	{
		return false;
	}
	else
	{
		return true;
	}		
  }