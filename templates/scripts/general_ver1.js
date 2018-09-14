$(document).ready(function(){
    $('.mp_faq_qa li').click(function() {
		
		var data_displ = $(this).data('displ');
		
		if ( data_displ == 'visible' ) {
			
			$(this).removeClass('mp_faq_answ_visible');
			$(this).addClass('mp_faq_answ_hid');
			$(this).data('displ','hidden');
			
		} else {
			
			$(this).removeClass('mp_faq_answ_hid');
			$(this).addClass('mp_faq_answ_visible');
			$(this).data('displ','visible');
			
		}
	
	});

    $(document).scroll(function() {
        updateHeaderView();
    });
    function updateHeaderView() {
        if($(document).scrollTop()>100 && $(document).scrollTop()<200){
            
            $('#header_wr').addClass('fixed_menu_wr');
            $('#header_wr').removeClass('fixed_menu_wr_show');
            
        } else if ( $(document).scrollTop()>=200 ) {
            
            $('#header_wr').addClass('fixed_menu_wr');
            $('#header_wr').addClass('fixed_menu_wr_show');
            
        } else {
            
            $('#header_wr').removeClass('fixed_menu_wr_show');
            $('#header_wr').removeClass('fixed_menu_wr');
            
        };
    }

    updateHeaderView();
    
    
    
    $("#show_menu_button").click(function() {
       $("#mobile_header_wr").addClass("show_mobile_header_wr");
    });
    $("#hide_menu_button").click(function() {
       $("#mobile_header_wr").removeClass("show_mobile_header_wr");
    });
    
    
    
    
    $('.toggle-click').click(function(event){
        
        var class_name = $(this).data('toggle-click-class');
        
        $(this).toggleClass(class_name);
        
    });
	
	/* submenu */
	
	$('.wrapper').click(function() {
		
		if ( $('#submenu_wrcl') && $('#submenu_wrcl').hasClass('show') === true ) {
			//$('#submenu_wrcl').removeClass('show');
		}
	});
	
	$('a#submenu').click(function(){
		
		

		$('#submenu_wrcl').toggleClass('show');
		
		$(document).scroll(function() {
			$('#submenu_wrcl').removeClass('show');
		});
		
		
	})
	
});
	
/* <show/hide block> */
    (function($) {
	$.fn.showHideBlock = function(options){
	  
		// default configuration properties
		var defaults = {			
			blockMaxHeight:          800,
			buttonId:                '',
			buttonNameShow:          'Show',
			buttonNameHide:          'Hide',
			onlyShow:                true,
			blockHiddenClass:        '',
			gradientHiddenClass:     '',
            gradientHeight:          80,
            useWindowResize:         true
		}; 
    
		var options = $.extend(defaults, options);
        
        this.each(function() {
            
            var obj = $(this); 
            var objHeight =  obj.height();
            var razn =  objHeight - options.blockMaxHeight;
            var opened = false;
            			
            if ( razn > options.gradientHeight*2 ) {
                
                obj.addClass(options.blockHiddenClass);
                obj.height(options.blockMaxHeight);              
                
                renameActionButton(options.buttonNameShow);
                showActionButton();
                
            } else {
                
                hideActionButton();
                
            }

            $('#' + options.buttonId).click(function(){
            
				if (obj.height() == options.blockMaxHeight) {
				
					showBlock();
					opened = true;
				
				} else {
				
					hideBlock();
					opened = false;
				
				}
            
            });
                

            
            if ( options.useWindowResize === true ) {
                
                $( window ).resize(function() {

                    if (opened === true) {
                        
                        obj.height('auto');
                        objHeight =  obj.height();
                        obj.height(objHeight);
						
						var razn =  objHeight - options.blockMaxHeight;
						
						if ( razn > options.gradientHeight*2 ) {
							
						} else {
							
							obj.removeClass(options.blockHiddenClass);
							hideActionButton();
							opened = false;
							
						}
						
                    } else {
                        
                        obj.height('auto');
                        objHeight =  obj.height();
						
						var razn =  objHeight - options.blockMaxHeight;
						
						if ( razn > options.gradientHeight*2 ) {
							
							obj.addClass(options.blockHiddenClass);
							
							renameActionButton(options.buttonNameShow);
							showActionButton();
							
							obj.height(options.blockMaxHeight);
							
						} else {
							
							obj.removeClass(options.blockHiddenClass);
							obj.removeClass(options.gradientHiddenClass);
							
							hideActionButton();
							
						}
                        
                    }

                });
                
            }
            
            function showBlock() {
                
                obj.height(objHeight);
                
                obj.addClass(options.gradientHiddenClass);
                
                if (options.onlyShow == true) {
                    
                    hideActionButton();
                    
                } else {
                    
                    renameActionButton(options.buttonNameHide);
                    
                }
                
            }
            
            function hideBlock() {
                
                obj.height(options.blockMaxHeight);
                
                obj.removeClass(options.gradientHiddenClass);
                
                if (options.onlyShow == true) {
                    
                    hideActionButton();
                    
                } else {
                    
                    renameActionButton(options.buttonNameShow);
                    
                }
                
            }
            
            function showActionButton() {
                
                $('#' + options.buttonId).show();
                
            }
            
            function hideActionButton() {
                
                $('#' + options.buttonId).hide();
                
            }
            
            function renameActionButton(text) {
                
                $('#' + options.buttonId).html(text);
                
            }
            
        });
    };
        
    })(jQuery);
/* <show/hide block> */

/***
	Simple message
***/
$(document).ready(function(){

	$(document).on("click", ".jsconfirmblock_wrapper", function(event){
		
        if ( $(this).hasClass('jsonlyhide') == true ) {
            $(this).hide();
        } else {
            $(this).remove();
        }
		
		// autosubmit
		if ( $(this).hasClass('jsaddsubmit') == true && $(this).data('jsformsubmitid') != "" ) {
			
			var submitid = $(this).data('jsformsubmitid');
			
			if ( $('#'+submitid) ) {
				
				$('#'+submitid).submit();
				
			}
			
		}

	});
	
	$(document).on("click", ".jsconfirmblock", function(event){
		
		event.stopPropagation();

	});
	
	$(document).on("click", ".jsconfirmblockclose", function(event){
		
        if ( $(this).closest('.jsconfirmblock_wrapper').hasClass('jsonlyhide') == true ) {
        	$(this).closest('.jsconfirmblock_wrapper').hide();
        } else {
        	$(this).closest('.jsconfirmblock_wrapper').remove();
        }
		
		// autosubmit
		if ( $(this).hasClass('jsaddsubmit') == true && $(this).data('jsformsubmitid') != "" ) {
			
			var submitid = $(this).data('jsformsubmitid');
			
			if ( $('#'+submitid) ) {
				
				$('#'+submitid).submit();
				
			}
			
		} else {
			
			return false;
			
		}
		
		
	});
	
	$(document).on("click", ".jsconfirmblock .ok-btn", function(event){
		
		$(this).closest('.jsconfirmblock_wrapper').remove();
				
		return true;
	});
	
});


/* <confirmation message> */
(function(f) {
	
	f.fn.setFormForConfirmCheck = function(options){
		
		// default configuration properties
		var defaults = {			
			wrapperBlockName:'jqconfirmblock_wrapper',
			confirmBlockName:'jqconfirmblock',
			confirmMessageBlockName:'jqconfirmblockmsg',
			confirmMessageBlockText:'Are you sure?',
			closeBlockName:'jqconfirmblockclose',
			controlBlockName:'jqconfirmblockcontrols',
			yesBlockName:'yes-btn',
			yesBlockText:'Yes',
			okBlockName:'ok-btn',
			okBlockText:'Ok',
			noBlockName:'no-btn',
			noBlockText:'No',
			simpleMessage:false,
			showCloseCrossButton:true
		}; 
    
		var options = f.extend(defaults, options);

		this.each(function() {
			
			f.Form = f(this);
			
			f.confirmBlockWr = f("<div class='" + options.wrapperBlockName + "'></div>").click(function(){
				f.confirmBlockWr.remove();
			});
			f.confirmBlock = f("<div class='" + options.confirmBlockName + "'></div>").click(function(event){
				event.stopPropagation();
			}).appendTo(f.confirmBlockWr);
			
			if (options.showCloseCrossButton === true) {
				f.confirmClose = f("<div class='" + options.closeBlockName + "'></div>").appendTo(f.confirmBlock).click(function(){
					f.confirmBlockWr.remove();
				});
			}
			
			f.confirmMessage = f("<div class='" + options.confirmMessageBlockName + "'>" + options.confirmMessageBlockText + "</div>").appendTo(f.confirmBlock);
			
			f.confirmBlockControls = f("<div class='" + options.controlBlockName + "'></div>");
			
			if (options.simpleMessage === true) {
				f.confirmNoButton = f("<div class='" + options.okBlockName + "'>" + options.okBlockText + "</div>").appendTo(f.confirmBlockControls).click(function(){
					f.confirmBlockWr.remove();
				});
			} else {
				f.confirmYesButton = f("<div class='" + options.yesBlockName + "'>" + options.yesBlockText + "</div>").appendTo(f.confirmBlockControls).click(function(){
					f.Form.submit();
				});
				f.confirmNoButton = f("<div class='" + options.noBlockName + "'>" + options.noBlockText + "</div>").appendTo(f.confirmBlockControls).click(function(){
					f.confirmBlockWr.remove();
				});
			}
			
			f.confirmBlockControls.appendTo(f.confirmBlock);
			
			
			f.confirmBlockWr.appendTo(f.Form);
			
		});
		
	};
	
})(jQuery);
/* </confirmation message> */

$(document).ready(function(){
	
	$('input[type=submit]', '#survey_form').click(function(){
		
		var form = $('#survey_form');
		
		var grade = $('select[name="grade"] option:selected', form).val();
		
		var files_amm = $('div.ajax-file-upload-statusbar').length;
		
		if ( (grade == 4 || grade == 5) && files_amm < 2 ) {
		
			$("#survey_form").setFormForConfirmCheck({
				
				confirmMessageBlockText: "Are you sure you want to submit Survey without adding the Graded Paper?"
				
			});
		
			return false;
			
		} else {
			
			return true;
			
		}
		
	});




	$('#userchangepassword').submit(function(event) {
		
		var form_leg = true;
		
		var current_password_inp = $('input[name=current_password]', this);
		var current_password_inp_val = current_password_inp.val();
		
		var new_password_inp = $('input[name=new_password]', this);
		var new_password_inp_val = new_password_inp.val();
		
		var new_password2_inp = $('input[name=new_password2]', this);
		var new_password2_inp_val = new_password2_inp.val();
		
		if ( current_password_inp_val == "" || new_password_inp_val == "" || new_password2_inp_val == "" ) {
			
			if ( new_password2_inp_val == "" ) {
				new_password2_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				new_password2_inp.focus();
			}
			
			if ( new_password_inp_val == "" ) {
				new_password_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				new_password_inp.focus();
			}
			
			if ( current_password_inp_val == "" ) {
				current_password_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				current_password_inp.focus();
			}
			
			form_leg = false;
			
		} else if ( current_password_inp_val == new_password_inp_val &&
					current_password_inp_val == new_password2_inp_val
					) {
			
			alert('You entered equal Current password and New password.');
			
			new_password_inp.val('');
			new_password2_inp.val('');
			
			new_password_inp.focus();
			
			form_leg = false;
			
		} else if ( new_password_inp_val != new_password2_inp_val ) {
			
			alert('Your typed and re-typed passwords does not equal.');
			
			new_password_inp.val('');
			new_password2_inp.val('');
			
			new_password_inp.focus();
			
			form_leg = false;
			
		}
		
		if ( form_leg === false ) {
		
			event.preventDefault();
			
		} else if ( form_leg === true ) {
			
			return true;
			
		}
		
	});
	
	$('#password_recovery').submit(function(event) {
		
		var form_leg = true;
		
		var email_inp = $('input[name=email]', this);
		var email_inp_val = email_inp.val();
		var valid_email = checkEmailOnValid(email_inp_val);
		
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
		
		if ( form_leg === false ) {
		
			event.preventDefault();
			
		} else if ( form_leg === true ) {
			
			return true;
			
		}
		
	});
	
	$('#password_recovery_change').submit(function(event) {
		
		var form_leg = true;
		
		var new_password1_inp = $('input[name=new_password1]', this);
		var new_password1_inp_val = new_password1_inp.val();
		
		var new_password2_inp = $('input[name=new_password2]', this);
		var new_password2_inp_val = new_password2_inp.val();
		
		if ( new_password1_inp_val == "" || new_password2_inp_val == "" ) {
			
			if ( new_password2_inp_val == "" ) {
				new_password2_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				new_password2_inp.focus();
			}
			
			if ( new_password1_inp_val == "" ) {
				new_password1_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				new_password2_inp.focus();
			}
			
			form_leg = false;
			
		} else if ( new_password1_inp_val != new_password2_inp_val ) {
			
			alert('Your typed and re-typed passwords does not equal.');
			
			new_password1_inp.val('');
			new_password2_inp.val('');
			
			new_password1_inp.focus();
			
			form_leg = false;
			
		}
		
		
		if ( form_leg === false ) {
		
			event.preventDefault();
			
		} else if ( form_leg === true ) {
			
			return true;
			
		}
		
	});

    $('.check-element').change(function(){
       
        var class_name = $(this).data('check-element');
        
        if ( $('.' + class_name).hasClass('checked') == true ) {
        
            $('.' + class_name).removeClass('checked');
        
        } else {
            
            $('.' + class_name).addClass('checked');
            
        }
        
    });
    
});



function setOrderFormTimeZone() {
	
	var date = new Date(); 
	var time_zone = (date.getTimezoneOffset())/(-60);
	$('#time_zone_input').val(time_zone);
	
}

function doShowTerms()
{
	var wndTerms = window.open('/show-terms-and-conditions.php', 'Terms', 'toolbar=0, location=0, directories=0, menubar=0, scrollbars=1, resizable=0, width=500, height=600, top=0, left='+(screen.width - 500), false);
}
$(document).ready(function(){

	$('a.of_show_terms_link').click(function(event) {
		
		var form_obj = $('form#orderform');
		
			var terms_inp = $('input[name=terms]', form_obj);
			var terms_inp_val = terms_inp.prop('checked');
			
			if ( terms_inp_val == false ) {
				terms_inp.prop('checked', true);
			}
		
	});
	
});
function doShowSurveyForm(id){
	window.open("/small-survey.php?id=" + id,"Survey","toolbar=0, location=0, directories=0, menubar=0, scrollbars=1, resizable=0, width=310, height=470, top=200, left=200",false);
	var elemId = "survey_" + id;
	document.getElementById(elemId).innerHTML="";
}


var txtRequiredField = '<b class=\"red\">This field is required</b>';

$(document).ready(function(){
	
	$('form#orderform').submit(function(event) {
		
		var form_leg = true;
		
		// check order data
			var topic_inp = $('input[name=topic]', this);
			var topic_inp_val = topic_inp.val();
			
			var numberofsources_sel = $('select[name=numberofsources]', this);
			var numberofsources_sel_val = numberofsources_sel.val();
			
			var additionaldetails_textarea = $('textarea[name=additionaldetails]', this);
			var additionaldetails_textarea_val = additionaldetails_textarea.val();
			
			var terms_inp = $('input[name=terms]', this);
			var terms_inp_val = terms_inp.prop('checked');
		
		// check contact info data
			if ( $('input[name=first_name]', this).length == true && $('input[name=email]', this).length == true ) {
				
				var first_name_inp = $('input[name=first_name]', this);
				var first_name_inp_val = first_name_inp.val();

				var email_inp = $('input[name=email]', this);
				var email_inp_val = email_inp.val();
				var valid_email = checkEmailOnValid(email_inp_val);
				
				var phone_number_inp = $('input[name=phone_number]', this);
				var phone_number_inp_val = phone_number_inp.val();
				var phone_number_inp_val_length = phone_number_inp_val.length;
				
				var password_inp = $('input[name=password]', this);
				var password_inp_val = password_inp.val();
				var password_inp_val_length = password_inp.val().length;
			
			}
			
			if ( terms_inp_val == false ) {
				$('#terms_error_row', this).html('You need to agree with our Terms & Conditions');
				
				$('html,body').animate({scrollTop: terms_inp.offset().top-50});
				form_leg = false;
			} else {
				$('#terms_error_row', this).html('');
			}
			
			if ( $('input[name=first_name]', this).length == true && $('input[name=email]', this).length == true ) {
				
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
				
				if ( phone_number_inp_val == "" || phone_number_inp_val_length < 10 ) {
					phone_number_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					phone_number_inp.focus();
				} else {
					phone_number_inp.removeClass('error');
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
				
				if ( first_name_inp_val == "" ) {
					
					first_name_inp.addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					first_name_inp.focus();
				} else {
					first_name_inp.removeClass('error');
				}
				
			}
			
			if ( additionaldetails_textarea_val == "" ) {
				
				additionaldetails_textarea.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				
				form_leg = false;
				additionaldetails_textarea.focus();
			} else {
				additionaldetails_textarea.removeClass('error');
			}

			if ( numberofsources_sel_val < 0 ) {
				
				numberofsources_sel.addClass('error').change(function(){
					$(this).removeClass('error');
				});
				
				form_leg = false;
				numberofsources_sel.focus();
			} else {
				numberofsources_sel.removeClass('error');
			}

			if ( topic_inp_val == "" ) {
				
				topic_inp.addClass('error').on('input', function(e){
					$(this).removeClass('error');
				});
				
				form_leg = false;
				topic_inp.focus();
			} else {
				topic_inp.removeClass('error');
			}
		
		if ( form_leg === false ) {
		
			event.preventDefault();
			
		} else if ( form_leg === true ) {
			
			if ( $('#aff_block_wr').length ) {
				
				var aff_bl_wr_obj = $('#aff_block_wr');
						
				var aff_show = aff_bl_wr_obj.data('aff-show');
				
				if ( aff_show === false ) {
					
					event.preventDefault();
					
					checkRandomUserOnPromoAff(this, aff_bl_wr_obj, email_inp_val);
										
				} else {
					
					return true;
				}
				
			} else {
				
				return true;
				
			}
			
		}
		
	});
	
	function checkRandomUserOnPromoAff(form, aff_bl_wr_obj, email) {
		
			jQuery.ajax({
				
				type: 'POST',
				url: '/action.php',
				dataType : 'json',
				data: ({'do':'get_i','get_i':'cruopaff','prm_email':email}),
				beforeSend: function () {
					
					canvasLoaderOn();
					
				},
				success: function(data) {
					
					answer = eval(data);
					
					if (answer.result == true) {
						
						aff_bl_wr_obj.show();
						
						$('input[name=affcode]', aff_bl_wr_obj).focus();
						
						aff_bl_wr_obj.data('aff-show', 'true');
						
					} else {
						
						form.submit();
						
						aff_bl_wr_obj.data('aff-show', 'true');
						
					}
					
					canvasLoaderOff();
					
				},
				complete: function() {
					
					canvasLoaderOff();
					
				}
				
			});
		
	}
	
});


function checkReferralEmailOnValid(form) {
	
	var email_inp = $('input[name=referral_email]', form);
	
	var email = email_inp.val();
	
	if (checkEmailOnValid(email) === true) {
		
		return true;
		
	} else {
		
		email_inp.focus();
		
		if (email=="") {
			
			alert("Empty field!");
			
		} else {
			
			alert("Invalid Email!");
			
		}
		
		return false;
	}
	
}

function checkEmailOnValid(email){
	
	if (!(/^[a-zA-Z0-9]+[a-zA-Z0-9_\-\.]+[a-zA-Z0-9]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+[a-zA-Z0-9]+$/.test(email))) {
		return false;
	} else {
		return true;
	}
	
}

/***
	web page refresh with timeout
***/
function refreshPage(n){window.setTimeout("Update();", n);}
function Update() {window.location.reload();}

function checkRequestRevisionForm(form) {
	
	var textarea_obj = $('textarea[name=revision_instructions]', form);
	
	var revision_instructions = textarea_obj.val();
	
	if ( revision_instructions == "" ) {
		
		textarea_obj.addClass('error').on('input', function(e){
			$(this).removeClass('error');
		});
		
		textarea_obj.focus();
		
		return false;
		
	} else {
		
		return true;
		
	}
	
}



function doCheckMessage(form) {
	
	var textarea_obj = $('textarea[name=message]', form);
	
	var message = textarea_obj.val();
	
	if ( message == "" ) {
		
		alert ('Please enter message');
		
		textarea_obj.addClass('error').on('input', function(e){
			$(this).removeClass('error');
		});
		
		textarea_obj.focus();
		
		return false;
		
	} else {
		
		return true;
		
	}
	
}

/* change selection color (need jquery)*/
function changeSelectionColor(group) {
	
	$(group).find("option").each(function(index){
		$(this).css('color', $(this).data('color'));
	});
	
	$(group).find("option:selected" ).each(function() {
		var new_color = $(this).data('color');
		$(this).parent().css('color', new_color);
    });
	
}

/***
    function checks for inputing all data into login form
***/
function checkLoginData(form)
{
	var email_obj = $('input[name=email]', form);
	var password_obj = $('input[name=password]', form);
	
	var email = email_obj.val();
	var valid_email = checkEmailOnValid(email);
	var password = password_obj.val();
	
	if ( email == "" || valid_email === false || password == "" ) {
		
		if ( password == "" ) {
			
			password_obj.addClass('error').on('input', function(e){
				$(this).removeClass('error');
			});
			
			password_obj.focus();
			
		}
		
		if ( email == "" || valid_email === false ) {
			
			if ( email == "" ) {
				$(email_obj).siblings('.of_error_txt').html('This is required field');
			} else if ( valid_email == false ) {
				$(email_obj).siblings('.of_error_txt').html('Incorrect Email!');
			}
			
			email_obj.addClass('error').on('input', function(e){
				$(this).removeClass('error');
			});
			
			email_obj.focus();
			
		}
		
		return false;
		
	} else {
		
		return true;
		
	}
	
}

	



function checkMessageData(a){
	if(a.message.value===""){
		alert("Please enter message");
		return false
	} else 
		return true
}



$(document).ready(function(){
	
	$('#survey_form select[name="grade"]').change(function(){
		
		if ( $('#survey_form .survey-grade-files-bl') ) {
			
			var grade = $('option:selected', this).val();
			
			if (grade==4 || grade==5) {
				
				$('#survey_form .survey-grade-files-bl').css('display','block');
					
			} else {
				
				$('#survey_form .survey-grade-files-bl').css('display','none');
				
			}
			
		}
		
	});
	
	$('#surv_conf_chk').click(function(){
		
		var form = $('#survey_form');
		
		var grade = $('select[name="grade"] option:selected', form).val();
		
		var files_amm = $('div.ajax-file-upload-statusbar').length;
		
		if ( (grade == 4 || grade == 5) && files_amm < 2 ) {
		
			$('.jsconfirmblock_wrapper').show();
			$('.jsconfirmblock').show("fast");

			var attr_name = $(this).attr('data-js-confirm');
			$('.jsconfirmblock').attr('data-js-confirm', attr_name);
		
			return false;
		
		} else {
			
			return true;
			
		}
		
	});
	
	// promo email
	$("#promo_discout_form").submit(function(event){
		
		var email = $("input[name=promo_email]", this).val();
		
		var valid_email = checkEmailOnValid(email);
		
		if ( valid_email === true ) {
			
			event.preventDefault();
			
			jQuery.ajax({
				
					type: 'POST',
					url: '/action.php',
					dataType : 'json',
					data: ({'get_json':'true','do':'set_promo_discount','type':'2','promo_email':email}),
					beforeSend: function () {
						
						canvasLoaderOn();
						
					},
					success: function(data) {
						
						createCookie('promomailshow', '1', 30);
						
						answer = eval(data);
						
						var message = $('#promo_discout_block_answ_wr');
						
						var message_det_bl = $(".msg_innner_bl .msg_title2", message).show();
						
						if (answer.result == 'success') {
							message_det_bl.addClass('color-green1');
							message_det_bl.removeClass('color-red1');
						}
						if (answer.result == 'fail') {
							message_det_bl.addClass('color-red1');
							message_det_bl.removeClass('color-green1');
						}
						
						message_det_bl.html(answer.showmessage);
						
						message.css({"opacity":"0","transition":"1s"}); 
						
						message.show();
						
						setTimeout(function(){
						  	
							message.css({"opacity":"1"});
							
						}, 100);
						
						canvasLoaderOff();
						
					},
					complete: function() {
						
						canvasLoaderOff();
						
						$("#promo_discout_form").remove();
						
					}
					
				});
				
			
			
		} else {
			
			var error_text = "Incorrect Email!";
			
			if ( email == "" ) error_text = "Empty Field!";
			
			$("body").setFormForConfirmCheck({
				confirmMessageBlockText: error_text,
				simpleMessage: true
			});
			$("input[name=promo_email]", this).focus();
			event.preventDefault();
			
		}		
		
	});
		
	$("#promo_discout_fixed_form").submit(function(event){
		
		var email_inp = $("input[name=promo_email]", this);
		var email = email_inp.val();
		
		var valid_email = checkEmailOnValid(email);
		
		if ( valid_email === true ) {
			
			event.preventDefault();
			
			jQuery.ajax({
				
					type: 'POST',
					url: '/action.php',
					dataType : 'json',
					data: ({'get_json':'true','do':'set_promo_discount','type':'1','promo_email':email}),
					beforeSend: function () {
						
						canvasLoaderOn();
						
					},
					success: function(data) {
						
						answer = eval(data);
						
						var message = $('#promo_discout_fixed_block_answ_wr');
						
						var message_det_bl = $(".msg_innner_bl .msg_title2", message);
						
						if (answer.result == 'success') {
							message_det_bl.addClass('color-green1');
							message_det_bl.removeClass('color-red1');
						}
						if (answer.result == 'fail') {
							message_det_bl.addClass('color-red1');
							message_det_bl.removeClass('color-green1');
						}
						
						message_det_bl.html(answer.showmessage);
						
						message.css({"opacity":"0","transition":"1s"}); 
						
						message.show();
						
						$("#promo_discout_fixed_block_wr").css({"opacity":"1","transition":"1s"});

						
						setTimeout(function(){
						  	
							message.css({"opacity":"1"});
							$("#promo_discout_fixed_block_wr").css({"opacity":"0"});
							
						}, 100);
						
						setTimeout(function(){
							$("#promo_discout_fixed_block_wr").remove();
						}, 1200);

						canvasLoaderOff();
						
					},
					complete: function() {
						
						canvasLoaderOff();
						
					}
					
				});
				
			
			
		} else {
			
			var error_text = "Incorrect Email!";
			
			if ( email == "" ) error_text = "Empty Field!";
			
			if ( email == "" ) {
				$(email_inp).siblings('.of_error_txt').html('This is required field');
			} else if ( valid_email == false ) {
				$(email_inp).siblings('.of_error_txt').html('Incorrect Email!');
			}
			
			email_inp.addClass('error').on('input', function(e){
				$(this).removeClass('error');
			});
				
			
			$("input[name=promo_email]", this).focus();
			event.preventDefault();
			
		}		
		
	});
	
});

	
function saveDiscountFixedBlockFormDetectInfo() {

	jQuery.ajax({
	
		type: 'POST',
		url: '/action.php',
		dataType : 'json',
		data: ({'do':'spddd','type':'1'}),
		success: function(data) {
			answer = eval(data);
		}
	
	});

}

/* canvas loader */
function canvasLoaderOn() {

	var body = $('body');
	
	if (!$('#canvasloader_container').length) {
		body.append('<div id="canvasloader_container"></div>');
	}

	var cl = new CanvasLoader('canvasloader_container');
		cl.setColor('#77c3e2'); // default is '#000000'
		cl.setShape('spiral'); // default is 'oval'
		cl.setDiameter(146); // default is 40
		cl.setDensity(111); // default is 40
		cl.setRange(1); // default is 1.3
		cl.setSpeed(3); // default is 2
		cl.show(); // Hidden by default
		
		// This bit is only for positioning - not necessary
		  var loaderObj = document.getElementById("canvasLoader");
  		loaderObj.style.position = "absolute";
  		loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
  		loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
		
}

function canvasLoaderOff() {
	$('#canvasloader_container').remove();
}
/*<canvasloader>*/
(function(w){var k=function(b,c){typeof c=="undefined"&&(c={});this.init(b,c)},a=k.prototype,o,p=["canvas","vml"],f=["oval","spiral","square","rect","roundRect"],x=/^\#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/,v=navigator.appVersion.indexOf("MSIE")!==-1&&parseFloat(navigator.appVersion.split("MSIE")[1])===8?true:false,y=!!document.createElement("canvas").getContext,q=true,n=function(b,c,a){var b=document.createElement(b),d;for(d in a)b[d]=a[d];typeof c!=="undefined"&&c.appendChild(b);return b},m=function(b,
c){for(var a in c)b.style[a]=c[a];return b},t=function(b,c){for(var a in c)b.setAttribute(a,c[a]);return b},u=function(b,c,a,d){b.save();b.translate(c,a);b.rotate(d);b.translate(-c,-a);b.beginPath()};a.init=function(b,c){if(typeof c.safeVML==="boolean")q=c.safeVML;try{this.mum=document.getElementById(b)!==void 0?document.getElementById(b):document.body}catch(a){this.mum=document.body}c.id=typeof c.id!=="undefined"?c.id:"canvasLoader";this.cont=n("div",this.mum,{id:c.id});if(y)o=p[0],this.can=n("canvas",
this.cont),this.con=this.can.getContext("2d"),this.cCan=m(n("canvas",this.cont),{display:"none"}),this.cCon=this.cCan.getContext("2d");else{o=p[1];if(typeof k.vmlSheet==="undefined"){document.getElementsByTagName("head")[0].appendChild(n("style"));k.vmlSheet=document.styleSheets[document.styleSheets.length-1];var d=["group","oval","roundrect","fill"],e;for(e in d)k.vmlSheet.addRule(d[e],"behavior:url(#default#VML); position:absolute;")}this.vml=n("group",this.cont)}this.setColor(this.color);this.draw();
m(this.cont,{display:"none"})};a.cont={};a.can={};a.con={};a.cCan={};a.cCon={};a.timer={};a.activeId=0;a.diameter=40;a.setDiameter=function(b){this.diameter=Math.round(Math.abs(b));this.redraw()};a.getDiameter=function(){return this.diameter};a.cRGB={};a.color="#000000";a.setColor=function(b){this.color=x.test(b)?b:"#000000";this.cRGB=this.getRGB(this.color);this.redraw()};a.getColor=function(){return this.color};a.shape=f[0];a.setShape=function(b){for(var c in f)if(b===f[c]){this.shape=b;this.redraw();
break}};a.getShape=function(){return this.shape};a.density=40;a.setDensity=function(b){this.density=q&&o===p[1]?Math.round(Math.abs(b))<=40?Math.round(Math.abs(b)):40:Math.round(Math.abs(b));if(this.density>360)this.density=360;this.activeId=0;this.redraw()};a.getDensity=function(){return this.density};a.range=1.3;a.setRange=function(b){this.range=Math.abs(b);this.redraw()};a.getRange=function(){return this.range};a.speed=2;a.setSpeed=function(b){this.speed=Math.round(Math.abs(b))};a.getSpeed=function(){return this.speed};
a.fps=24;a.setFPS=function(b){this.fps=Math.round(Math.abs(b));this.reset()};a.getFPS=function(){return this.fps};a.getRGB=function(b){b=b.charAt(0)==="#"?b.substring(1,7):b;return{r:parseInt(b.substring(0,2),16),g:parseInt(b.substring(2,4),16),b:parseInt(b.substring(4,6),16)}};a.draw=function(){var b=0,c,a,d,e,h,k,j,r=this.density,s=Math.round(r*this.range),l,i,q=0;i=this.cCon;var g=this.diameter;if(o===p[0]){i.clearRect(0,0,1E3,1E3);t(this.can,{width:g,height:g});for(t(this.cCan,{width:g,height:g});b<
r;){l=b<=s?1-1/s*b:l=0;k=270-360/r*b;j=k/180*Math.PI;i.fillStyle="rgba("+this.cRGB.r+","+this.cRGB.g+","+this.cRGB.b+","+l.toString()+")";switch(this.shape){case f[0]:case f[1]:c=g*0.07;e=g*0.47+Math.cos(j)*(g*0.47-c)-g*0.47;h=g*0.47+Math.sin(j)*(g*0.47-c)-g*0.47;i.beginPath();this.shape===f[1]?i.arc(g*0.5+e,g*0.5+h,c*l,0,Math.PI*2,false):i.arc(g*0.5+e,g*0.5+h,c,0,Math.PI*2,false);break;case f[2]:c=g*0.12;e=Math.cos(j)*(g*0.47-c)+g*0.5;h=Math.sin(j)*(g*0.47-c)+g*0.5;u(i,e,h,j);i.fillRect(e,h-c*0.5,
c,c);break;case f[3]:case f[4]:a=g*0.3,d=a*0.27,e=Math.cos(j)*(d+(g-d)*0.13)+g*0.5,h=Math.sin(j)*(d+(g-d)*0.13)+g*0.5,u(i,e,h,j),this.shape===f[3]?i.fillRect(e,h-d*0.5,a,d):(c=d*0.55,i.moveTo(e+c,h-d*0.5),i.lineTo(e+a-c,h-d*0.5),i.quadraticCurveTo(e+a,h-d*0.5,e+a,h-d*0.5+c),i.lineTo(e+a,h-d*0.5+d-c),i.quadraticCurveTo(e+a,h-d*0.5+d,e+a-c,h-d*0.5+d),i.lineTo(e+c,h-d*0.5+d),i.quadraticCurveTo(e,h-d*0.5+d,e,h-d*0.5+d-c),i.lineTo(e,h-d*0.5+c),i.quadraticCurveTo(e,h-d*0.5,e+c,h-d*0.5))}i.closePath();i.fill();
i.restore();++b}}else{m(this.cont,{width:g,height:g});m(this.vml,{width:g,height:g});switch(this.shape){case f[0]:case f[1]:j="oval";c=140;break;case f[2]:j="roundrect";c=120;break;case f[3]:case f[4]:j="roundrect",c=300}a=d=c;e=500-d;for(h=-d*0.5;b<r;){l=b<=s?1-1/s*b:l=0;k=270-360/r*b;switch(this.shape){case f[1]:a=d=c*l;e=500-c*0.5-c*l*0.5;h=(c-c*l)*0.5;break;case f[0]:case f[2]:v&&(h=0,this.shape===f[2]&&(e=500-d*0.5));break;case f[3]:case f[4]:a=c*0.95,d=a*0.28,v?(e=0,h=500-d*0.5):(e=500-a,h=
-d*0.5),q=this.shape===f[4]?0.6:0}i=t(m(n("group",this.vml),{width:1E3,height:1E3,rotation:k}),{coordsize:"1000,1000",coordorigin:"-500,-500"});i=m(n(j,i,{stroked:false,arcSize:q}),{width:a,height:d,top:h,left:e});n("fill",i,{color:this.color,opacity:l});++b}}this.tick(true)};a.clean=function(){if(o===p[0])this.con.clearRect(0,0,1E3,1E3);else{var b=this.vml;if(b.hasChildNodes())for(;b.childNodes.length>=1;)b.removeChild(b.firstChild)}};a.redraw=function(){this.clean();this.draw()};a.reset=function(){typeof this.timer===
"number"&&(this.hide(),this.show())};a.tick=function(b){var a=this.con,f=this.diameter;b||(this.activeId+=360/this.density*this.speed);o===p[0]?(a.clearRect(0,0,f,f),u(a,f*0.5,f*0.5,this.activeId/180*Math.PI),a.drawImage(this.cCan,0,0,f,f),a.restore()):(this.activeId>=360&&(this.activeId-=360),m(this.vml,{rotation:this.activeId}))};a.show=function(){if(typeof this.timer!=="number"){var a=this;this.timer=self.setInterval(function(){a.tick()},Math.round(1E3/this.fps));m(this.cont,{display:"block"})}};
a.hide=function(){typeof this.timer==="number"&&(clearInterval(this.timer),delete this.timer,m(this.cont,{display:"none"}))};a.kill=function(){var a=this.cont;typeof this.timer==="number"&&this.hide();o===p[0]?(a.removeChild(this.can),a.removeChild(this.cCan)):a.removeChild(this.vml);for(var c in this)delete this[c]};w.CanvasLoader=k})(window);
/*</canvasloader>*/


/* <Cookies Functions> */
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
/* </Cookies Functions> */

/* <to delete> */
function dump(obj) {
    
    var out = "";
    
    if(obj && typeof(obj) == "object"){
        
        for (var i in obj) {
            
            out += i + ": " + obj[i] + "\n";
            
        }
    } else {
        
        out = obj;
        
    }
    
    console.log(out);
    
}
/* </to delete> */

$(document).ready(function(){
	$('.call-us-inline-block').dblclick(function() {
		eraseCookie('promomailshow');
		location.reload();
	});
});

/* <Get Fast  message> */
$(document).ready(function(){
(function($) {
	
	$.fn.fastMessage = function(options){
		
		// default configuration properties
		var defaults = {
			time_out:	15000, // 1 second = 1000ms
			req_url:	false,
			css_transition:	2000,
			audio_play: true
		};
		
		var options = $.extend(defaults, options);
		
		this.each(function() {
			
			var obj = $(this);
			var obj_width = obj.width();
			var audio_complete = false;
			
			function getFastMessages() {
				
				if (options.req_url) {
					
					jQuery.ajax({
						type: 'POST',
						url: options.req_url,
						data: ({'do' : 'get_i', 'get_i' : 'gms'}), 
						success: function(data) {
							// Json

							var answer = eval("(" + data + ")");
							
							audio_complete = false;
							
							showMessages(answer);
							
						}
					});
					
				}
				
				setTimeout(function(){
					getFastMessages();
				},options.time_out);
				
			};
			
			function showMessages(msgs) {
				
				obj.css({'width':obj_width});
				
				for (var id in msgs) {
					
					if (checkMessageExist(id) === false) {
						if (msgs[id]['checked'] != 1) {
							
							printMessage(id, msgs[id]);
							
							var user_seen = msgs[id]['user_seen'];
							
							if (audio_complete == false && user_seen !== true ) {
								playAudio();
							}
							
						}
					}
					
				}
				
				deleteNotExistingMessagesMessages(msgs);
				
				setTimeout(function(){
					obj.css({'width':'auto'});
				},options.css_transition);
				
			}
			
			function deleteNotExistingMessagesMessages(msgs) {
				
				var prmsgs = $('div.msgs_det_bl', obj);
				
				if (prmsgs.length > 0) {
					
					for (var i=0; i < prmsgs.length; i++) {
						
						var m_id = $(prmsgs[i]).attr('data-js-fmsg-id');
						
						if ( msgs == null || msgs[m_id] == null ) {
							
							deleteMessage(m_id);
							
						}
						
					}
					
				}
				
			}
			
			function checkMessageExist(m_id) {
				
				var exist = false;
				
				if ($('div#fm_' + m_id, obj).length) {
					
					exist = true;
					
				}
				
				return exist;
			}
			
			function printMessage(m_id, msgs) {
				
				var mes_div = 
				$('<div/>', {
					id:'fm_' + m_id,
					class:'msgs_det_bl',
					'data-js-fmsg-id':m_id
				}).appendTo(obj);
				
				var mes_kr_del = 
				$('<div/>', {
					id:'fm_del_' + m_id,
					class:'msgs_kr_del',
					'data-js-fm-id':m_id
				}).appendTo(mes_div)
				.click(function(){
					reqCheckMessages(m_id);
				});
				
				var mes_text_div = 
				$('<div/>', {
					class:'msgs_text_bl'
				}).appendTo(mes_div);
				
				var mes_a_info = getMessageDetails(msgs);
				
				var mes_a = 
				$('<a/>', {
					href:mes_a_info['link'],
					target:'_blank',
					'data-msg-type':msgs['type']
				}).appendTo(mes_text_div)
				.html(mes_a_info['text'])
				.click(function(){
					reqCheckMessages(m_id);
				});
				
				setTimeout(function(){
					mes_div.css({'margin-right':'20px'});
				},300);
				
			}
			
			function deleteMessage(m_id) {
				
				var m_to_del = $('div#fm_' + m_id, obj);
				
				if (m_to_del) {
					
					m_to_del
					.css('transition', '0.5s')
					.css('margin-top', '125px')
					.css('overflow', 'hidden')
					.css('width', '0')
					.css('padding', '0')
					.css('margin-left', '0')
					.css('margin-right', '0')
					.css('margin-bottom', '0')
					.css('border', '0')
					.html('')
					.delay(500)
					.queue(
						function() {
							$(this).remove(); 
					});
					
				}
				
			}
			
			function reqCheckMessages(m_id) {
				
				jQuery.ajax({
						type: 'POST',
						url: options.req_url,
						data: ({'do':'get_i','get_i':'check_msg','check_msg_id':m_id}), 
						success: function(data) {
							// Json

							var answer = eval("(" + data + ")");
							
							deleteMessage(m_id);
							
						}
					});
				
			}
			
				setTimeout(function(){
					getFastMessages();
				},1000);
			
			function playAudio() {
				if (options.audio_play === true) {
					var audio = $('#fast_mesgs_audio')[0];
					audio.play();
				}
				audio_complete = true;
			}
			
				/*
					customer_id, customer_name, order_id, order_number, text
				*/
				function getMessageDetails(msgs) {
					
					info = new Array;
					
					switch (msgs['type']) {
						
						case 1: // Order on Hold
							info['link'] = '/room.php';
							info['text'] = 'Order #' + msgs['order_number'] + ' is on hold';
						break;
						
						case 2: // Order Completed
							info['link'] = '/order-details.php?id=' + msgs['order_id'];
							info['text'] = 'Order #' + msgs['order_number'] + ' is completed!';
						break;
						
						case 3: // New Message from Support
							info['link'] = '/show-messages.php?id=' + msgs['order_id'] + '#last';
							info['text'] = 'New Message from Support';
						break;
						
						case 4: // New Message from Writer
							info['link'] = '/show-messages.php?id=' + msgs['order_id'] + '#last';
							info['text'] = 'New Message from Writer';
						break;
						
						case 5: // Draft File Uploaded
							info['link'] = '/order-details.php?id=' + msgs['order_id'];
							info['text'] = 'Draft Uploaded: #' + msgs['order_number'];
						break;
						
						default: // DEFAULT
						
							if (msgs['link']) {
								info['link'] = msgs['link'];
							} else {
								info['link'] = '#';
							}
							
							if (msgs['text']) {
								info['text'] = msgs['text'];
							} else {
								info['text'] = 'Empty message';
							}
							
						break;

					}
					
					return info;
				}
				
		});
	
	};
	
})(jQuery);
});
/* </Get Fast  message> */


/* <bottom fixed/notfixed banner> */
$(document).ready(function(){
	
	posBottomBanner();
	
	$(document).scroll(function(){
		
		posBottomBanner();
		
	});
	
	$( window ).resize(function() {
		
		posBottomBanner();
		
	});
	
	function posBottomBanner() {
		
		var bfb_obj = $('#bottomfixedbanner');
		var bfb_height = $('#bottomfixedbanner').outerHeight();
		
		var bfb_c_obj = $('#bottomfixedbanner_c');
		
		var footer_obj = $('#wr_footer');
		var footer_height = $('#wr_footer').outerHeight();
		
		var window_height = $(window).outerHeight();;
		var document_height = $(document).outerHeight();;
		
		var scroll_top = $(window).scrollTop();
		var scroll_bottom = $(window).scrollTop() + window_height;
		
		var height_to_fix = document_height - footer_height;
		
		if ( scroll_bottom < height_to_fix ) {
			
			bfb_obj.addClass('bfb_fixed');
			$('#bottomfixedbanner_c').height(bfb_height);
			
		} else {
			
			bfb_obj.removeClass('bfb_fixed');
			$('#bottomfixedbanner_c').height(0);
			
		}
		
	}
	
});
/* </bottom fixed/notfixed banner> */

$(document).ready(function(){
	
	$('#rsmob').click(function(){
		
		var mop = $(this).data('mop');
		
		jQuery.ajax({
			type: 'POST',
			url: '/room.php',
			dataType: 'json',
			data: ({'mop':mop}), 
			beforeSend: function () {
				
				canvasLoaderOn();
				
			},
			success: function(data) {
				
				var answ = eval(data);
				
				var mop_box = $('<div></div>').append(answ.rol_html)
				
				$('#rol_cont').append(mop_box);
				
				var mop_box_height = $(mop_box).css('height', 'auto').height();
				
				$(mop_box).css('height', '0px').animate({height: mop_box_height}, 1000, function(){ $(this).height('auto'); });
				
				var answ = eval(data);
				
				if ( answ.rol_end == true ) {
					$('#rsmob_cont').remove();
				} else {
					$('#rsmob').data('mop', (mop+1));
				}
			
			},
			complete: function() {
				
				canvasLoaderOff();
				
			}
			
		});
		
	});
	
    /***
        Sign In Form
    ***/
    $('.login_button_click').click(function(){
        $('#logblwr').show();
    });

    $('#sign_in_f').submit(function(event) {
        
        var form_leg = true;
        
        var form_obj = $(this);
        var email_inp_obj = $('input[name=email]', this);
        var email_inp_val = $(email_inp_obj).val();
        var valid_email = checkEmailOnValid(email_inp_val);
        
        var password_inp_obj = $('input[name=password]', this);
        var password_inp_val = $(password_inp_obj).val();
        var password_inp_val_length = password_inp_val.length;
        
        // if checkEmailOnValid()
        
				if ( password_inp_val == "" || password_inp_val_length < 4 ) {
					
					if ( password_inp_val == "" ) {
						$(password_inp_obj).siblings('.of_error_txt').html('This is required field');
					} else if ( password_inp_val_length < 4 ) {
						$(password_inp_obj).siblings('.of_error_txt').html('Min - 4 symbols');
					}
					
					$(password_inp_obj).addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					$(password_inp_obj).focus();
                    
				} else {
                    
					$(password_inp_obj).removeClass('error');
                    
				}
		
				if ( email_inp_val == "" || valid_email == false ) {
					
					if ( email_inp_val == "" ) {
						$(email_inp_obj).siblings('.of_error_txt').html('This is required field');
					} else if ( valid_email == false ) {
						$(email_inp_obj).siblings('.of_error_txt').html('Incorrect Email!');
					}
					
					$(email_inp_obj).addClass('error').on('input', function(e){
						$(this).removeClass('error');
					});
					
					form_leg = false;
					email_inp_obj.focus();
                    
				} else {
					email_inp_obj.removeClass('error');
				}
        
		if ( form_leg === false ) {
		
			event.preventDefault();
			
		} else if ( form_leg === true ) {
			
			return true;
			
		}
        
    });
	
	setTimeout(function () {
		if ( $('.prsf_bl').length > 0 ) {
			$('.prsf_bl').addClass('prsf_bl_shown');
		}
	}, 100);
	
});

/* <Canvas ProgressBar> */
$(document).ready(function(){

(function($) {
	
	$.fn.canvasProgressBar = function(options){
		
		// default configuration properties
		var defaults = {
			time_left:	600, // 10min
			step_miliseconds: 30,
			arcbias: -0.5, // smechenie
			width: 400,
			maxwidth: 400,
			lineWidth: 30,
			useAdaptive: true,
			showDays:	true,
			showHours:	true
		};
		
		var options = $.extend(defaults, options);
		
		var colorLightInd = "20";
		
		var time_out = options.step_miliseconds;
		
		var seconds_counter = options.time_left,
			seconds_left = seconds_counter;
		
		this.each(function() {
			
			var target_date = new Date("2019-02-14 16:26:00").getTime();
			var days, hours, minutes, seconds;
			var $days = $("#prbar_days"),
				$hours = $("#prbar_hours"),
				$minutes = $("#prbar_minutes"),
				$seconds = $("#prbar_seconds");
			  
			var center = options.width/2,
				canvas = this,
				ctx = canvas.getContext("2d"),
				daySetup = {
					radie:170,
					lineWidth:options.lineWidth,
					back:48,
					color:"#98dafc",
					backcolor:"#98dafc"+colorLightInd,
					counter:0,
					old:0
				},
				hourSetup = {
					radie:130,
					lineWidth:options.lineWidth,
					back:48,
					color:"#ff6a70",
					backcolor:"#ff6a70"+colorLightInd,
					counter:0,
					old:0
				},
				minSetup = {
					radie:90,
					lineWidth:options.lineWidth,
					back:45,
					color:"#0096e3",
					backcolor:"#0096e3"+colorLightInd,
					counter:0,
					old:0
				},
				secSetup = {
					radie:50,
					lineWidth:options.lineWidth,
					back:65,
					color:"#ffce00",
					backcolor:"#ffce00"+colorLightInd,
					counter:0,
					old:0
				}

				// set colors to counters
					$days.css('color',daySetup.color);
					$hours.css('color',hourSetup.color);
					$minutes.css('color',minSetup.color);
					$seconds.css('color',secSetup.color);
				
				// width of canvas
				
				options.width = (minSetup.radie+options.lineWidth)*2;
				
				if ( options.showHours === true ) {
					options.width = (hourSetup.radie+options.lineWidth)*2;
				} else {
					$("#prbar_hours_bl").remove();
				}
				
				if ( options.showDays === true ) {
					options.width = (daySetup.radie+options.lineWidth)*2;
				} else {
					$("#prbar_days_bl").remove();
				}
				
				center = options.width/2;
				
				if ( options.useAdaptive === true ) {
					$(this).width = 1000;
					$(this).height = 1000;
					$(this).attr({width:options.width,height:options.width}).css({'width':'100%','max-width':options.width+'px','max-height':options.width});
				}
				
			var check = function(count, setup, ctx, usegencolor=false) {
					if (count < setup.old){
					  setup.counter++
					}
					draw(setup, count, ctx, usegencolor);
				},
				draw = function(setup, count, ctx, usegencolor=false) {
					radie = setup.radie;
					lineWidth = setup.lineWidth;
					color = setup.color;
					if ( usegencolor!=true ) {
						count = 2;
						color = setup.backcolor;
					}
					ctx.beginPath();
					ctx.arc(center, center, radie, options.arcbias*Math.PI, (count+options.arcbias) * Math.PI, false);
					ctx.lineWidth = lineWidth;
					ctx.strokeStyle = color;
					ctx.stroke();
				};
				
			var timerId = 
			setInterval(function () {
				canvas.width = options.width;
				
				ctx.beginPath();

				ctx.lineWidth = options.lineWidth,

				ctx.fill();
				
				
				seconds_counter = seconds_counter - (options.step_miliseconds/1000);
				
				if ( seconds_counter < 0 ) {
					seconds_counter = 0;
					clearInterval(timerId);
					window.location.reload();
				}
				
				seconds_left = seconds_counter;
				
				//var current_date = new Date().getTime();
				//var seconds_left = (target_date - current_date) / 1000;
				//console.log(current_date/1000);

				days = parseInt(seconds_left / 86400);
				seconds_left = seconds_left % 86400;
				 
				hours = parseInt(seconds_left / 3600);
				seconds_left = seconds_left % 3600;
				 
				minutes = parseInt(seconds_left / 60);
				seconds = seconds_left % 60;
				 
				if ( options.showDays === true )
					$days.text(days);
				if ( options.showHours === true )
					$hours.text(hours);
				$minutes.text(minutes);
				$seconds.text(parseInt(seconds));

				var dayCount = (2 / 365) * days,
				  hourCount = (2 / 24) * hours,
				  minCount = (2 / 60) * minutes,
				  secCount = (2 / 60) * seconds;
				  
				check(secCount, secSetup, ctx, true);
				check(minCount, minSetup, ctx, true);
				if ( options.showHours === true )
					check(hourCount, hourSetup, ctx, true);
				if ( options.showDays === true ) 
				check(dayCount, daySetup, ctx, true);

				check(secCount, secSetup, ctx);
				check(minCount, minSetup, ctx);
				if ( options.showHours === true )
					check(hourCount, hourSetup, ctx);
				if ( options.showDays === true ) 
					check(dayCount, daySetup, ctx);

				secSetup.old = secCount - 0.01;
				minSetup.old = minCount - 0.01;
				hourSetup.old = hourCount - 0.01; 
				daySetup.old = dayCount - 0.01; 
				
			}, time_out);
			
			
			
		});
		
		
		
		
	}

})(jQuery);

});
/* </Canvas ProgressBar> */