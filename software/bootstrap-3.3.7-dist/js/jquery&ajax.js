. "<script>
					$(document).ready(function () {
				 	$('.btn').click(function () {
						var value= $('.select').val();		//getting value of select box with class='select'
						$.ajax({
							url: 'art.localhost',
							method: 'POST',
							data: {value : value},			//sending value to yourphppage
								 success:function(data){
			
							$('#show').html(data);			//here response from server will be display
							}
						  });
						});
					 });
				</script>"