(function(){"use strict";var order_total=0;var order_type_cost=0;var order_type_title='';var order_additional_options=0;var conversion_inner_page=0;var conversion_inner_page_cost=0;var conversion_cost=49;var extra_options='';var option_value='';var coupon_code='HTML5';var discount=0;var coupon_value='';var discount_amt=0;var discounted_price=0;var list_options='';var discount_percentage=20;var discvalue=0;var disctyp=0;var product_quantity=1;var currency=$('#currency').val();var show_price=$('#show_price').val();$(document).ready(function(e)
{var cat1=$(".order-opt-link").attr('id');$("#"+cat1).addClass("active");$('.pdcts').hide();$('.catdesc').hide();$('.proddesc').hide();$('#catdesc'+cat1).show();$('[data-catid='+cat1+']').show();var pdct=$('[data-catid='+cat1+']').attr('id');$('#proddesc'+pdct).show();$('.opns').hide();$('#order_btn_2').hide();if($('[data-pdct='+pdct+']').length==0){$("#add_options").hide()}
    if($('[data-catid='+cat1+']').length==0){$("#order_summary_box").hide();$('#order_btn_2').show()}
    $('[data-pdctid='+pdct+']').show();$('#product').val(pdct);$('input[name=customer_choice]:text').val($('[data-catid='+cat1+']').attr('data-productname'));$('input[name=customer_sub_choice]:text').val("");cart_update()});function reset_data()
{order_total=0;discount=0;order_type_cost=0;product_quantity=1;$('.check-opt').prop('checked',!1);$("#pack-add").html('<li id="nothing">No Option Selected</li>');$(".pdcteach").removeClass("active");$('#dis_price').html("");$('#coupon_text').val("");$('#product_quantity').val(1);$("#no_prod").val(0);$("#add_options").show();$('#order_btn_2').hide();$("#order_summary_box").show();$('input[name=customer_choice]:text').val("");$('input[name=customer_sub_choice]:text').val("")}
    function cart_update()
    {order_additional_options=0;$('input[name=customer_choice]:text').val($('.pdcteach.active').attr('data-productname'));order_type_cost=$(".pdcteach.active").attr('data-cost1');$('input[name=type_cost]:text').val(order_type_cost);$("input:checkbox[class=check-opt]:checked").each(function(){$('input[name=customer_sub_choice]:text').val($(this).attr('data'));order_additional_options=order_additional_options+Number($(this).attr('data-cost2'))});discount_amt=0;product_quantity=$("#product_quantity").val();order_total=Number(order_type_cost*product_quantity)+order_additional_options;if(discount==1)
    {if(disctyp=='P')
    {discount_amt=(order_total*discvalue/100).toFixed(2)}
        if(disctyp=='C')
        {discount_amt=discvalue}
        if(disctyp=='P')
        {$('#dis_price').html('<span>'+currency+'</span>'+order_total+' - '+discvalue+'% discount ('+currency+''+discount_amt+') = '+currency+''+(order_total-discount_amt).toFixed(2))}
        if(disctyp=='C')
        {$('#dis_price').html('<span>'+currency+'</span>'+order_total+' - '+'discount ('+currency+''+discvalue+') = '+currency+''+(order_total-discount_amt).toFixed(2))}
        discounted_price=order_total-discount_amt;$('input[name=actual_amt]:text').val(order_total);$('input[name=reduction]:text').val(discount_amt);order_total=discounted_price}
        $('input[name=order_total_amt]:text').val(order_total.toFixed(2));$('#order_total').html('<span>'+currency+'</span>'+(order_total.toFixed(2)));return!1}
    function default_value_setting()
    {order_additional_options=0;conversion_inner_page=0;conversion_inner_page_cost=0;$('#dis_price').html('');discount=0;$('input[name=type_cost]:text').val(order_type_cost);$('input[name=coupon_text]:text').val('');$('input[name=conversion_inner_pages]:text').val(0);$('input[name=etaDropDown]:text').val('3 Day');$(".pack-add").html('<li id="nothing">No Option Selected</li>')}
    $(".order-opt-link").on("click",function(){reset_data();$(".order-opt-link").removeClass("active");$(this).addClass("active");var cat=$(this).attr('id');$('.pdcts').hide();$('.catdesc').hide();$('#catdesc'+cat).show();$('[data-catid='+cat+']').show();var prdct=$('[data-catid='+cat+']').attr('id');$('.proddesc').hide();$('#proddesc'+prdct).show();$('#product').val(prdct);$("#normal-pk"+prdct).addClass("active");if($('[data-pdct='+prdct+']').length==0){$("#add_options").hide()}
        if($('[data-catid='+cat+']').length==0){$("#order_summary_box").hide();$('#order_btn_2').show()}
        $('.opns').hide();$('[data-pdctid='+prdct+']').show();cart_update()});$(".pdcts").on("click",function(){reset_data();var prdct=$(this).attr('id');$('.proddesc').hide();$('#proddesc'+prdct).show();$("#normal-pk"+prdct).addClass("active");if($('[data-pdct='+prdct+']').length==0){$("#add_options").hide()}
        $('.opns').hide();$('[data-pdctid='+prdct+']').show();$('#product').val(prdct);cart_update()});$("#discnt_btn_id").on("click",function()
    {$('#dis_price').html('<img src="img/load.gif">');$.ajax({type:"post",url:"checkcoupon.php",data:"coupon="+$("#coupon_text").val()+"&product="+$("#product").val(),success:function(data){if(data!=0)
        {var res=data.split("|");discvalue=res[0];disctyp=res[1];discount=1;cart_update()}
        else{$('#dis_price').html('Coupon code is not valid')}},error:function()
        {alert("error")}})});$(document).delegate('.check-opt','click',function()
    {var liid='';var newval='';var latvalue='';if($(this).is(':checked'))
    {newval=$(this).attr('value').split(currency);latvalue=newval[1].split(']');order_additional_options+=Number(latvalue[0]);liid=$(this).attr('id');$("#nothing").remove();if(show_price==1)
    {$(".pack-add").append('<li id="res'+liid+'">'+($(this).attr('value'))+'</li>')}
        if(show_price==0)
        {$(".pack-add").append('<li id="res'+liid+'">'+($(this).attr('data'))+'</li>')}}
    else{newval=$(this).attr('value').split(currency);latvalue=newval[1].split(']');order_additional_options-=Number(latvalue[0]);liid=$(this).attr('id');$("#res"+liid+"").remove()}
        cart_update()});$('input[name=product_quantity]:text').keyup(function(e)
    {if(isNaN($(this).val())||$(this).val()==0)
    {$(this).val(1);cart_update()}
    else{cart_update()}});$('input[name=conversion_inner_pages]:text').keyup(function(e)
    {if(isNaN($(this).val()))
    {$(this).val(0)}
    else{conversion_inner_page=$(this).val();conversion_inner_page=Number(conversion_inner_page);conversion_inner_page_cost=conversion_inner_page*conversion_cost;var con_dropdown_cnt=$('input[name=etaDropDown]:text');$('input[name=innerpage_cost]:text').val(conversion_inner_page_cost);if(conversion_inner_page==0)
        con_dropdown_cnt.val('3 Day');else if(conversion_inner_page==1||conversion_inner_page==2)
        con_dropdown_cnt.val('4 Day');else if(conversion_inner_page==3||conversion_inner_page==4)
        con_dropdown_cnt.val('5 Day');else if(conversion_inner_page==5||conversion_inner_page==6)
        con_dropdown_cnt.val('6 Day');else if(conversion_inner_page==7||conversion_inner_page==8)
        con_dropdown_cnt.val('7 Day');else if(conversion_inner_page==9||conversion_inner_page==10)
        con_dropdown_cnt.val('8 Day');else con_dropdown_cnt.val('Let me estimate');cart_update()}});$('#order_btn_id').on("click",function(e)
    {e.preventDefault();$('#order_frm').submit()});$('#order_btn_id2').on("click",function(e){e.preventDefault();$("#no_prod").val(1);$('#order_frm').get(0).setAttribute('action','thankyou.php');$('#order_frm').submit()});$('input:text, textarea').keyup(function(e){$('#error_order').css('display','none')});$('#order_frm').submit(function(e)
    {if($('input[name=customer_name]:text').val()=='')
    {$('#error_order').css('display','block').html('Please enter your name');$('input[name=customer_name]:text').focus();return!1}
    else if($('input[name=customer_email]:text').val()=='')
    {$('#error_order').css('display','block').html('Please enter your email');$('input[name=customer_email]:text').focus();return!1}
    else if(!validate_email($('input[name=customer_email]:text').val()))
    {$('#error_order').css('display','block').html('Please enter your valid email');$('input[name=customer_email]:text').focus();return!1}
    else if($('textarea[name=customer_message]').val()=='')
    {$('#error_order').css('display','block').html('Please enter your project description');$('textarea[name=customer_message]').focus();return!1}
    else{return!0}});function validate_email(email)
    {var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;return reg.test(email)}})(jQuery)