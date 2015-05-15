$(document).ready(function() {
	
	$("#login").click(function() {
	
		var action = $("#form1").attr('action');
		var form_data = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success')
					$("#form1").slideUp('slow', function() {
						$("#message").html("<p class='success'>You have logged in successfully!</p>");
						top.location.href='promotion.php';
					});
				else
					$("#message").html("<p class='error'>Invalid username and/or password.</p>");	
			}
		});
		
		return false;
	});
	
});