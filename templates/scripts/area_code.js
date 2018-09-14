	function setOrderFormAreaCode() {
		
		jQuery.ajax({
			type: 'POST',
			url: '/',
			dataType: 'json',
			data: ({'do':'get_i','get_i':'ge_ip_info'}), 
			success: function(data) {
			
					var phone_number = data.phone_number;

					var inp_field = document.getElementById('orderform');
					
					if (phone_number!="" && phone_number!=undefined) {
						inp_field.phone_number.value = phone_number;
					}
			
			}
		});
		
	}


