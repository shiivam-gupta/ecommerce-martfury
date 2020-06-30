$(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });
});
$(document).ready(function(){
  $("#cb01").click(function(){
    if($(this).prop("checked") == true){
        $(".secondAddress").removeClass("d-none");
        $('#first_name_other').prop('required', true);
        $('#last_name_other').prop('required', true);
        $('#email_other').prop('required', true);
        $('#phone_other').prop('required', true);
        $('#country_other').prop('required', true);
        $('#state_other').prop('required', true);
        $('#city_other').prop('required', true);
        $('#address_other').prop('required', true);
    }
    else if($(this).prop("checked") == false){
        $(".secondAddress").addClass("d-none");
        $('#first_name_other').prop('required', false);
        $('#last_name_other').prop('required', false);
        $('#email_other').prop('required', false);
        $('#phone_other').prop('required', false);
        $('#country_other').prop('required', false);
        $('#state_other').prop('required', false);
        $('#city_other').prop('required', false);
        $('#address_other').prop('required', false);
    }
});
});

$(document).on('click','.down',function(){
    var quantity = $(this).parents('tr').find(".quantity").val();
    if (quantity > 1) {
        var allQuantity = quantity - 1;
        $(this).parents('tr').find(".quantity").val(allQuantity);
    }else{
        alert('Quantity should not be less than 1.');
    }
});
$(document).on('click','.up',function(){
    var quantity = $(this).parents('tr').find(".quantity").val();
    if(quantity=='')
    {
        quantity = 1;
    }
    var allQuantity = parseInt(quantity) + parseInt(1);
    $(this).parents('tr').find(".quantity").val(allQuantity);
});

$('#apply-coupon').click(function() {
	var coupon_code = document.getElementById('coupon_code').value;
	var total_tax = $("#total_tax").val();
	console.log(coupon_code);
	if(coupon_code==null || coupon_code=='')
	{
		$("#show-error").html('Please enter coupon code before press the apply button.');
		return;
	}
	$.ajax({
    type: "POST",
    url: appurl+"apply-coupon",
    data: 'coupon_code='+coupon_code+'&total_tax='+total_tax,
    success: function(data){
      if(data['status']=='applied')
      {
        $("#coupon_code").prop('readonly', true);
        $("#apply-coupon").prop('disabled', true);
        $("#show-error").hide();
        $("#show-success").html(data['message']);
        $("#show-success").show();

        $("#discountAmount").html(data['total_discount']);
        $("#totalAmount").html(data['totalAmount']);
        $("#total_discount").val(data['total_discount']);
        $("#total").val(data['totalAmount']);
      }
      else
      {
      	$("#coupon_code").prop('readonly', false);
      	$("#show-success").hide();
      	$("#show-error").html('Invalid coupon code. please try another coupon code.');
      	$("#show-error").show();
      }
    }
  });
});