$(document).ready(function(){
	
	$('#ipcf').submit(function(event){
		
		var payment_email_obj = $('input[name=payment_email]', this);
		var payment_email_val = $(payment_email_obj).val();
		var payment_email_valid = checkEmailOnValid(payment_email_val);
		
		if ( payment_email_valid === true ) {
			
			$(payment_email_obj).removeClass('error');
			
			return true;
			
		} else {
			
			$(payment_email_obj).siblings('.of_error_txt').html('Incorrect Email!');
			
			$(payment_email_obj).focus();
			
			payment_email_obj.addClass('error').on('input', function(e){
				$(payment_email_obj).removeClass('error');
			});
			
			event.preventDefault();
			
		}
		
	});

	$('#aff_tr_form input[name="transfer_amount"]').on("change paste keyup", function(){
		
		var tr_str = $(this).val();
		
		if ( tr_str.indexOf(',') >= 0 ) {
			
			var tr_str = tr_str.replace(",", ".");
			$(this).val(tr_str);
			
		}
		
	});
	$('#aff_tr_form').submit(function(event){
		
		var min_amm = 10;
		
		var tm_obj = $('input[name="transfer_amount"]', this);
		var tm = roundNAff(parseFloat(tm_obj.val()));
		var max_p = roundNAff(parseFloat($('input[name=max_p]', this).val()));
		
		if (isNaN(tm) == true) {
			alert("Error!");
			tm_obj.val(max_p);
			event.preventDefault();
		} else 
		if ( tm > max_p ) {
			alert("You have only $"+max_p+" credits");
			tm_obj.val(max_p);
			event.preventDefault();
		} else 
		if ( tm < min_amm ) {
			alert("Transfer amount must be above $"+min_amm);
			tm_obj.val(min_amm);
			event.preventDefault();
		} else { 
			var audio_obj = $('#aff_tr_a');
			if ( audio_obj.length > 0 ) {
				
				event.preventDefault();
				var audio = audio_obj[0];
				canvasLoaderOn();
				audio.play();
				setTimeout(function(){
					$('#aff_tr_a').remove();
					$('#aff_tr_form').submit();
				}, 800);
				
			} else {
				return true;
			}
		}
		
	});
	
	function roundNAff(c) {
		return Math.round(c*Math.pow(10,2))/Math.pow(10,2);
	}
	
});