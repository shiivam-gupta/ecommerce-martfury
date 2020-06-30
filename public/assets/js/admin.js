(function($) {
	"use strict";
	
	$(document).on('click','.deleteData',function(e) {
		var id = $(this).data("id");
		var dataurl = $(this).attr("data-url");
		event.preventDefault();
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data.",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				//var _token = $('#csrfToken').attr('content');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('#csrfToken').attr('content')
					}
				});
				$.ajax({
					url:dataurl,
					method:'DELETE',
					data:{
						id:id
					}
				});
				swal("Poof! Your data has been deleted!", {
					icon: "success",
				});
				$('#usersDetails').DataTable().ajax.reload();
				setTimeout(function(){
					location.reload()
				},10)
			} else {
				swal("Your data is safe!");
			}
		});
	});

	$(document).on('click','.changetype',function(e) {
		var status = $(this).data('status'); 
		var user_id = $(this).data('id');
		var dataurl = $(this).attr("data-url");

		$.ajax({
			type: "GET",
			dataType: "json",
			url: dataurl,
			data: {'status': status, 'user_id': user_id},
			success: function(data){
				// console.log(data.success)
				swal("Status has been changed", {
					icon: "success",
				});
				$('#usersDetails').DataTable().ajax.reload();
				setTimeout(function(){
					location.reload()
				},10)
			}
		});
	});

	var number = 0;
	$('#Images').on('change', function(){
	    var filelists = this.files || [];        
	    $.each(filelists, function(i, filelist){
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $( '.preview-' + number ).html('<img class="image-preview" src="'+ e.target.result +'" width=75/>'); 
	            number ++ ;
	            
	        }
	        reader.readAsDataURL(filelist);
	         
	    });  
	   
	});

	$(document).on('click','.add-more',function(){
		var html = `<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<input type="file" class="allImage" name="images[]" accept="image/*" maxlength="50" accept=".png, .jpg, .jpeg" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<a href="javascript:void(0)" class="btn btn-primary remove-more">Remove</a>
							</div>
						</div>
					</div>`;
		$('.product-image').append(html);
	})

	$(document).on('click','.remove-more',function(){
		$(this).parent().parent().parent().remove();
	});

	$(document).on('change','.allImage', function(){       
	    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $(this).val('');
        } 
	});

	$(document).on('click','.removeImg',function(){
		var _this = $(this);
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data.",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				var imageId = $(this).attr('data-id');
				var dataurl = $(this).attr("data-url");
				_this.parent().remove();
				$.ajax({
					type: "GET",
					dataType: "json",
					url: dataurl,
					data: {'imageId': imageId},
					success: function(data){

						swal("Image Deleted Successfully", {
							icon: "success",
						});

					}
				});
			}
		});
	})


})(jQuery);