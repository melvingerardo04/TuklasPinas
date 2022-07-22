function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}

function enterAmountOnly(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
		return false;
	}else{
		return true; 
	}
}

function numAndPeriod(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
		return false;
	}else{
		return true; 
	}
}