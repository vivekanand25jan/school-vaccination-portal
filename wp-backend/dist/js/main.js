$(document).ready(function(){
	$(document).on('click','#deleteAgency',function(){
		var confirmval = confirm('do you want to delete the agency ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

	$(document).on('click','#changeAgencyStatus',function(){
		var confirmval = confirm('do you want to change the agency status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});



	$(document).on('click','#deletepcc',function(){
		var confirmval = confirm('do you want to delete the pcc ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

	$(document).on('click','#changepccStatus',function(){
		var confirmval = confirm('do you want to change the pcc status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});



	$(document).on('click','#deleteproblem',function(){
		var confirmval = confirm('do you want to delete the problem ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

	$(document).on('click','#changeproblemStatus',function(){
		var confirmval = confirm('do you want to change the problem status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});


	$(document).on('click','#deleteproduct',function(){
		var confirmval = confirm('do you want to delete the product ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

	$(document).on('click','#changeproductStatus',function(){
		var confirmval = confirm('do you want to change the product status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});



	$(document).on('click','#deletestatus',function(){
		var confirmval = confirm('do you want to delete the status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

	$(document).on('click','#changestatusStatus',function(){
		var confirmval = confirm('do you want to change the status ?');
		if(confirmval == true){
			return true;
		}else{
			return false;
		}
	});

});