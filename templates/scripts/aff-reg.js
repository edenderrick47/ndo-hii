$(document).ready(function(){
	
	$('#scrll_aff_t').click(function () {$('body,html').animate({scrollTop: 0}, 400); return false;});
	
	$('form#aprf').submit(function(event) {
		
		var form_obj = $(this);
		
		var form_leg = true;
		
		var terms_inp = $('input[name=terms]', this);
		var terms_inp_val = terms_inp.prop('checked');
		
		var first_name_inp = $('input[name=first_name]', this);
		var first_name_inp_val = first_name_inp.val();

		var phone_number_inp = $('input[name=phone_number]', this);
		var phone_number_inp_val = phone_number_inp.val();

		var email_inp = $('input[name=email]', this);
		var email_inp_val = email_inp.val();
		var valid_email = checkEmailOnValid(email_inp_val);
		
		var password_inp = $('input[name=password]', this);
		var password_inp_val = password_inp.val();
		var password_inp_val_length = password_inp.val().length;
		
			if ( terms_inp_val == false ) {
				$('#terms_error_row', this).html('You need to agree with our Terms & Conditions');
				
				$('html,body').animate({scrollTop: form_obj.offset().top-100});
				form_leg = false;
			} else {
				$('#terms_error_row', this).html('');
			}
		
				if ( password_inp_val == "" || password_inp_val_length < 4 ) {
					
					if ( password_inp_val == "" ) {
						$(password_inp).siblings('.of_error_txt').html('This is required field');
					} else if ( password_inp_val_length < 4 ) {
						$(password_inp).siblings('.of_error_txt').html('Min - 4 symbols');
					}
					
					password_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					password_inp.focus();
				} else {
					password_inp.removeClass('error');
				}
				
				if ( email_inp_val == "" || valid_email == false ) {
					
					if ( email_inp_val == "" ) {
						$(email_inp).siblings('.of_error_txt').html('This is required field');
					} else if ( valid_email == false ) {
						$(email_inp).siblings('.of_error_txt').html('Incorrect Email!');
					}
					
					email_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					email_inp.focus();
				} else {
					email_inp.removeClass('error');
				}
				
				if ( phone_number_inp_val == "" ) {
					
					phone_number_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					phone_number_inp.focus();
				} else {
					phone_number_inp.removeClass('error');
				}
		
				if ( first_name_inp_val == "" ) {
					
					first_name_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					first_name_inp.focus();
				} else {
					first_name_inp.removeClass('error');
				}
		
		if ( form_leg === false ) {
			
			event.preventDefault();
			
		} else {
			
			return true;
			
		}
		
	});
	
	$('.checktrms').click(function(){
		
		var t_obj = $('#trmscond');
		var terms_inp_val = $(t_obj).prop('checked');
		
			if ( terms_inp_val == false ) {
				t_obj.prop('checked', true);
			}
		
	});
	
});